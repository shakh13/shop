<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Collections;
use libphonenumber\PhoneNumber;
$user = Yii::$app->user->identity;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="assets/b49b5e2a/jquery.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="navbar-fixed" style="height: 46px;">
    <nav id="myshop_nav">
        <div class="nav-wrapper blue darken-3">
        <?= Html::a(Html::img('images/logo.png', ['style' => 'padding: 4px; height: 46px;']), ['/site'], ['class' => 'brand-logo']) ?>
        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li class="active"><?= Html::a('<i class="material-icons">home</i>', ['/site']) ?></li>
            <li><?= Html::a("<i class='material-icons'>favorite</i>", ['/site/favorites']) ?></li></li>
            <li id="nav_profile">
                <a class="dropdown-profile" href="#!" data-activates="profile-dropdown"><i class="material-icons right">arrow_drop_down</i><i class="material-icons right">person</i></a>
                <ul id="profile-dropdown" class="dropdown-content">
                    <?=
                        Yii::$app->user->isGuest ?
                            "<li>".Html::a('Войти', ['/site/login'])."</li>"
                            ."<li>".Html::a('Создать аккаунт', ['/site/signup'])."</li>"
                            :
                            "<li>".Html::beginForm(['/site/logout']).Html::submitButton("Выйти(".$user->profile->name.")").Html::endForm()."</li>";
                    ?>
                </ul>
            </li>
        </ul>
            <?php
                if (!Yii::$app->user->isGuest){
                    $basketCount = \app\models\Basket::find()->where(['user_id' => Yii::$app->user->id, 'status' => 0])->count();
                    echo Html::a(($basketCount ? "<span class='count'>".$basketCount."</span>" : '')."<i class='material-icons right' style='width: 46px; margin-left: 0; margin-right: 5px; text-align: center'>shopping_cart</i>", ['/site/shoppingcart']);
                }
            ?>
        <?= '' ?>
        <a href="#search" style="margin: 0;" id="search">
            <i class="material-icons right" style="width: 46px; margin-left: 0; text-align: center">search</i>
        </a>
        <div id="search-p" class="none">
            <?=
                Html::beginForm(['/site/search'], 'get')
                    .Html::tag('i', 'search', ['class' => 'material-icons'])
                    .Html::input('search', 'q', Yii::$app->request->getQueryParam('q'), ['class' => 'q', 'placeholder' => 'Я ищу...'])
                    .Html::a('<i class="material-icons">close</i>', '#close', ['style' => 'color: #333', 'id' => 'close-q'])
                .Html::endForm()
            ?>
        </div>
    </div>
    </nav>
</div>
<div class="side-nav" id="mobile-menu">
    <div class="user-logo blue darken-3">
        <img src="<?= Yii::$app->user->getPicturePath() ?>">
        <div class="content">
            <?=
                Yii::$app->user->isGuest ?
                    Html::a('Привет<span class="subheader">Вход не выполнено</span>', ['/site/login'])
                    :
                    Html::a($user->profile->first_name."<span class='subheader'>US $".$user->profile->cash."</span>", ['/profile'])
            ?>
        </div>
    </div>
    <?php
        if (!Yii::$app->user->isGuest){
            ?>
            <div class="collections blue darken-4">
                <a href="#">
                    <i class="material-icons" style="color: rgba(255,255,255,.4);">notifications_none</i>
                    <div class="content" style="color: #FFF; text-transform: uppercase; letter-spacing: 3px">Уведомления</div>
                </a>
            </div>
            <?php
        }


        $collections = Yii::$app->user->isGuest ?
            [
                 [
                         'url' => ['/site/login'],
                     'icon' => 'perm_identity',
                     'content' => 'Войти'
                 ]
            ]
            :
            [
              [
                  'url' => ['/site/index'],
                  'icon' => 'home',
                  'content' => 'Главная'
              ],
                [
                        'url' => ['/profile/index'],
                    'icon' => 'account_circle',
                    'content' => 'Мой профиль'
                ],
                [
                        'url' => ['/site/orders'],
                    'icon' => 'assignment',
                    'content' => 'Мои заказы'
                ],
                [
                        'url' => ['/site/shoppingcart'],
                    'icon' => 'shopping_cart',
                    'content' => 'Корзина'
                ],
                [
                        'url' => ['/site/favorites'],
                    'icon' => 'favorites',
                    'content' => 'Избранное'
                ],
                [
                        'url' => ['/site/messages'],
                    'icon' => 'email',
                    'content' => 'Сообщения'
                ],
                [
                        'url' => 'divider'
                ],
                [
                        'url' => ['/site/settings'],
                    'icon' => 'settings',
                    'content' => 'Настройки',
                ],
                ['url' => 'divider'],
                [
                        'url' => ['/site/feedback'],
                    'icon' => 'grade',
                    'content' => 'Обратная связь'
                ],
                [
                        'url' => ['/site/supportservice'],
                    'icon' => 'headset_mic',
                    'content' => 'Служба поддержки'
                ]

            ];

        Collections::doit($collections);



        if (!Yii::$app->user->isGuest){
            ?>
            <div class="collections">
                <div class="divider"></div>
                <?=
                Html::beginForm(['/site/logout'])
                .Html::submitButton('<i class="material-icons">exit_to_app</i>
                    <div class="content">Выход</div>')
                .Html::endForm()
                ?>
            </div>
            <?php
        }
    ?>
</div>

    <div class="contain">
        <?= $content ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
