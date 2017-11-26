<?php
namespace frontend\controllers;

use app\models\Address;
use app\models\Basket;
use app\models\ProductPhotos;
use app\models\Products;
use app\models\Shopping;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['signup', 'logout'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $newProducts = Products::find()->where(['status' => 1])->limit(100)->orderBy('created_at')->all();
        $reklamaProductds = ProductPhotos::find()->where('reklama IS NOT NULL and status=1')->limit(5)->orderBy('RAND()')->all();
        return $this->render('index', [
            'reklamaProducts' => $reklamaProductds,
            'newProducts' => $newProducts,

        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionSearch(){
        $q = Yii::$app->request->getQueryParam('q');

        return $this->render('search', [
            'user' => Yii::$app->user->identity,
            'q' => $q,
        ]);
    }

    public function actionShoppingcart(){

        if (Yii::$app->user->isGuest){
            return $this->redirect(['/site/login']);
        }

        $user = Yii::$app->user->identity;

        $basket = Basket::find()->where(['user_id' => $user->id, 'status' => 0])->all();

        return $this->render('shoppingcart', [
            'user' => Yii::$app->user->identity,
            'basket' => $basket,
        ]);
    }

    public function actionOrders(){

        $user = Yii::$app->user->identity;

        $orders = Shopping::find()->where(['user_id' => $user->id])->orderBy('created_at')->all();

        return $this->render('orders', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    public function actionSettings(){
        $user = Yii::$app->user->identity;

        $a = Yii::$app->request->getQueryParam('action');

        $action = 'settings';
        $c = [];

        $def_address = Yii::$app->request->post('default_address');
        if ($def_address) {
            $check = Address::findOne(['user_id' => $user->id, 'status' => 1, 'id' => $def_address]);
            if ($check){
                $check->dflt = 1;
                $check->save();
            }
        }

        switch ($a){
            case 'delivery_address':

                $action = 'settings_delivery_address';

                $addresses = Address::find()->where(['user_id' => $user->id, 'status' => 1])->all();

                $c = [
                    'user' => $user,
                    'addresses' => $addresses,
                ];
                break;

            case 'add_address':
                $action = 'settings_add_address';

                $c = [
                    'user' => $user
                ];
                break;

            case 'delete_address':

                $addr_id = Yii::$app->request->getQueryParam('id');

                if ($addr_id){
                    $check = Address::findOne(['id' => $addr_id, 'user_id' => $user->id, 'status' => 1]);
                    if ($check){
                        $check->status = 0;
                        $check->save();

                        return $this->redirect(['/site/settings', 'action' => 'delivery_address']);
                    }
                }
                else {
                    $action = "settings";
                    $c = [
                        'user' => $user
                    ];
                }

                break;

            case 'currency':
                $action = 'settings_currency';
                $c = [
                    'user' => $user,
                ];
                break;

            case 'language':
                $action = 'settings_language';
                $c = [
                    'user' => $user,
                ];
                break;

            case 'preferences':
                $action = 'settings_preferences';
                $c = [
                    'user' => $user,
                ];
                break;

            case 'notifications':
                $action = 'settings_notifications';
                $c = [
                    'user' => $user,
                ];
                break;

            case 'currency_converter':
                $action = 'settings_currency_converter';
                $c = [
                    'user' => $user,
                ];
                break;

            case 'privacy_policy':
                $action = 'settings_privacy_policy';
                $c = [
                    'user' => $user,
                ];
                break;

            default:
                $action = 'settings';
                $c = [
                    'user' => $user,
                ];
                break;
        }

        return $this->render($action, $c);
    }
}
