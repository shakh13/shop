<?php

namespace frontend\controllers;

use app\models\Basket;
use app\models\Comments;
use app\models\Favorites;
use app\models\ProductPhotos;
use app\models\Products;
use app\models\ProductSizes;
use SebastianBergmann\CodeCoverage\InvalidArgumentException;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;

use yii\filters\VerbFilter;

class ProductsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'addtofavorites' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView(){
        $id = Yii::$app->request->getQueryParam('id');

        if ($id){
            $product = Products::find()->where(['id' => $id, 'status' => 1])->one();

            if ($product){
                return $this->render('view', [
                    'product' => $product
                ]);
            }
            else {
                throw new HttpException(404, Yii::t('yii', 'Product not found'), 404);
            }
        }
        else {
            return $this->redirect(Yii::$app->request->referrer ? Yii::$app->request->referrer : ['/site']);
        }
    }



    public function actionSendcomment(){
        $retUrl = Yii::$app->request->getQueryParam('_retUrl');
        $user = Yii::$app->user;
        $product = Yii::$app->request->post('product');

        if (!Yii::$app->user->isGuest && $retUrl && $product){
            $basket = Basket::find()->where(['user_id' => $user->id, 'product_id' => $product, 'status' => 2])->one();
            if ($basket){

                $content = Yii::$app->request->post('comment');
                if ($content){
                    $comment = new Comments();
                    $comment->user_id = $user->id;
                    $comment->product_id = $product;
                    $comment->content = $content;
                    $comment->save();
                }

            }


            return $this->redirect($retUrl);
        }
        else {
            return $this->goHome();
        }
    }

    public function actionAddtofavorites(){
        $pid = Yii::$app->request->post('product_id');

        if (Yii::$app->user->isGuest)
            return $this->asJson(['added' => false]);

        if ($pid){
            $product = Products::findOne($pid);

            if (!$product && !count($product)) return $this->asJson(['added' => false]);

            $fav = Favorites::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $pid]);

            if ($fav) {
                return $this->asJson(['added' => !$fav->delete()]);
            }
            else {
                $fav = new Favorites();
                $fav->user_id = Yii::$app->user->id;
                $fav->product_id = $pid;

                return $this->asJson(['added' => $fav->save()]);
            }
        }

        return $this->asJson(['added' => false]);
    }

    public function actionAddtobasket(){

        $pid = Yii::$app->request->getQueryParam('product_id');

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        if (!$pid) {
            return $this->render('error_page', [
                'msg' => 'Product not found'
            ]);
        }

        $product = Products::find()->where(['id' => $pid, 'status' => 1])->one();


        if (!$product) {
            return $this->render('error_page', [
                'msg' => 'Product not found'
            ]);
        }


        $msg = [];

        $basket = new Basket();
        $basket->product_id = $pid;
        $basket->user_id = Yii::$app->user->id;
        $basket->status = 0;
        if ($basket->load(Yii::$app->request->post())){

            $checkBasket = Basket::find()->where(['product_id' => $basket->product_id, 'p_size_id' => $basket->p_size_id, 'p_photo_id' => $basket->p_photo_id, 'user_id' => $basket->user_id])->one();

            if ($checkBasket){
                $msg = [
                    'status' => 'success',
                    'content' => 'Товар уже существует с такими характеристиками'
                ];

                return $this->redirect(['/products/view', 'id' => $pid, $msg]);
            }
            else {
                $p_size = ProductSizes::find()->where(['id' => $basket->p_size_id, 'product_id' => $pid])->one();
                if ($p_size){
                    $p_color = ProductPhotos::find()->where(['id' => $basket->p_photo_id, 'product_id' => $pid, 'status' => 1, ])->one();
                    if ($p_color){
                        if ($basket->save()){
                            $msg = [
                                'status' => 'success',
                                'content' => 'Товар успешно добавлено в корзину.',
                            ];
                            return $this->redirect(['/products/view', 'id' => $pid, $msg]);
                        }
                        else {
                            $msg = [
                                'status' => 'error',
                                'content' => 'Неудается добавить товар в корзину.',
                            ];
                        }
                    }
                    else {
                        if (ProductPhotos::findOne($basket->p_photo_id)){
                            if ($basket->save()){
                                $msg = [
                                    'status' => 'success',
                                    'content' => 'Товар успешно добавлено в корзину.',
                                ];
                                return $this->redirect(['/products/view', 'id' => $pid, 'msg' => $msg]);
                            }
                            else {
                                $msg = [
                                    'status' => 'error',
                                    'content' => 'Неудается добавить товар в корзину.',
                                ];
                            }
                        }
                        else {
                            $msg = [
                                'status' => 'error',
                                'content' => 'Пожалуйста, выберите цвет товара.',
                            ];
                        }
                    }
                }
                else {
                    if (ProductSizes::findOne($basket->p_size_id)){
                        if ($basket->save()){
                            $msg = [
                                'status' => 'success',
                                'content' => 'Товар успешно добавлено в корзину.',
                            ];
                            return $this->redirect(['/products/view', 'id' => $pid, $msg]);
                        }
                        else {
                            $msg = [
                                'status' => 'error',
                                'content' => 'Неудается добавить товар в корзину.',
                            ];
                        }
                    }
                    else {
                        $msg = [
                            'status' => 'error',
                            'content' => 'Пожалуйста, выберите размер товара.',
                        ];
                    }
                }
            }
        }

        return $this->render('addtobasket', [
            'product' => $product,
            'msg' => $msg,
        ]);
    }

}
