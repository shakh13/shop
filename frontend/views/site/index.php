<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Discount';
?>
<div class="row">
    <div class="col s12" style="padding: 0;">
        <ul class="tabs">
            <li class="tab col s6"><a class="active" href="#tab_news">Что новенького</a></li>
            <li class="tab col s6"><a href="#tab_like">Вам понравится</a></li>
        </ul>
    </div>
    <div id="tab_news" class="col s12" style="padding: 0;">
        <div class="slider">
            <ul class="slides">
                <?php
                    if (count($reklamaProducts)){
                        foreach ($reklamaProducts as $product){
                            ?>
                                <li>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['/products/view', 'id' => $product->product_id]) ?>">
                                        <img src="images/products/<?= $product->path ?>">
                                        <div class="caption center-align">
                                            <h3><?= Yii::$app->maxWord($product->product->content, 40) ?></h3>
                                            <h5>US $<?= $product->product->price ?></h5>
                                        </div>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                    else {
                        echo "No Products";
                    }
                ?>
            </ul>
        </div>
        <ul class="centered categories" id="categories">
            <li>
                <?= Html::a("<i class=\"material-icons\">list</i>Все категории", ['/products/allcategories'], ['class' => 'red-text']) ?>
            </li>
            <li>
                <?= Html::a("<i class=\"material-icons\">local_mall</i>Сумки и обувь", ['/products/category', 'id' => 5], ['class' => 'teal-text 
                darken-3']) ?>
            </li>
            <li>
                <?= Html::a("<i class=\"material-icons\">child_friendly</i>Всё для детей", ['/products/category', 'id' => 6], ['class' =>
                    'light-blue-text']) ?>
            </li>
            <li>
                <?= Html::a("<i class=\"material-icons\">directions_run</i>Спорт и развлечения", ['/products/category', 'id' => 7], ['class' =>
                    'red-text']) ?>
            </li>
            <li>
                <?= Html::a("<i class=\"material-icons\">face</i>Красота и здаровье", ['/products/category', 'id' => 8], ['class' => 'brown-text 
                lighten-4']) ?>
            </li>
            <li>
                <?= Html::a("<i class=\"material-icons\">watch</i>Бижутерия и часы", ['/products/category', 'id' => 9], ['class' => 'purple-text 
                text-darken-4']) ?>
            </li>
            <li>
                <?= Html::a("<i class=\"material-icons\">lightbulb_outline</i>Ваше мнение", ['/site/support'], ['class' => 'orange-text']) ?>
            </li>
            <li>
                <?= Html::a("<i class=\"material-icons\">local_atm</i><!-- attach_money -->Конвертер валют", ['/site/converter'], ['class' =>
                    'green-text']) ?>
            </li>
        </ul>
        <div class="mycard">
            <h5 class="light bold">
                Бренд-фокус
                <span class="right">
                    <?= Html::a('ЕЩЁ', ['/products/brandfocus']) ?>
                </span>
            </h5>
            <div class="card">
                <div class="card-image">
                    <img src="images/images.jpg">
                </div>
            </div>
        </div>

        <div class="mycard">
            <h5 class="light bold">Горящие товары</h5>
            <div class="row">
                <div class="col s4">
                    <div class="card grey lighten-2">
                        <div class="card-image">
                            <img src="images/p1.jpg">
                            <span style="font-weight: bold" class="card-title pink lighten-1">US $12.99</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p><br>I am a very simple card.</p>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card grey lighten-2">
                        <div class="card-image">
                            <img src="images/p2.jpg">
                            <span style="font-weight: bold" class="card-title pink lighten-1">US $12.99</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p><br>I am a very simple card.</p>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card grey lighten-2">
                        <div class="card-image">
                            <img src="images/p3.jpg">
                            <span style="font-weight: bold" class="card-title pink lighten-1">US $12.99</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p><br>I am a very simple card.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mycard">
            <h5 class="light bold">Народное мнение</h5>
            <div class="row">
                <div class="col s4">
                    <div class="card">
                        <div class="card-image">
                            <div class="header">iTao: избранное</div>
                            <img src="images/p4.jpg">
                            <div class="card_center_img">
                                <img src="images/f1.jpg">
                            </div>
                        </div>
                        <div class="card-content">
                            D_A_N_I_Y_A<br>
                            <label>Мастер шоппинга</label>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card">
                        <div class="card-image">
                            <div class="header">Отзивы с фото</div>
                            <img src="images/p4.jpg">
                        </div>
                        <div class="card-content">
                            <ul class="centered categories">
                                <li class="bold">
                                    13<i class="material-icons grey-text lighten-4">collections</i>
                                </li>
                                <li class="bold">
                                    913<i class="material-icons grey-text lighten-4">thumb_up</i>
                                </li>
                                <li class="bold">
                                    313<i class="material-icons grey-text lighten-4">comment</i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card">
                        <div class="card-image">
                            <div class="header">iTao: избранное</div>
                            <img src="images/p4.jpg">
                            <div class="card_center_img">
                                <img src="images/f1.jpg">
                            </div>
                        </div>
                        <div class="card-content">
                            Sofia<br>
                            <label>Мастер шоппинга</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mycard">
            <h5 class="light bold">Коллекции магазинов</h5>
            <div class="row">
                <div class="col s6">
                    <div class="mc">
                        <div class="header">SHAKH MODA Store</div>
                        <div class="subheader">99.0% положительных отзывов</div>
                        <img src="images/f6.jpg">
                    </div>
                </div>
                <div class="col s6">
                    <div class="mc">
                        <div class="header">SHAKH MODA Store</div>
                        <div class="subheader">99.0% положительных отзывов</div>
                        <img src="images/f5.jpg">
                    </div>
                </div>
            </div>
        </div>

        <div class="mycard">
            <h5 class="light bold">На пределе возможностей<span class="right"><a href="#">ЕЩЁ</a></span></h5>
            <div class="row">
                <div class="col s4">
                    <div class="mc">
                        <img src="images/f4.jpg">
                        <div class="content">US $13.00</div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="mc">
                        <img src="images/f3.jpg">
                        <div class="content">US $13.00</div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="mc">
                        <img src="images/f2.jpg">
                        <div class="content">US $13.00</div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="mc">
                        <img src="images/f1.jpg">
                        <div class="content">US $13.00</div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="mc">
                        <img src="images/f5.jpg">
                        <div class="content">US $13.00</div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="mc">
                        <img src="images/f6.jpg">
                        <div class="content">US $13.00</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mycard">
            <h5 class="light bold">Трендовые вещи<span class="right"><a href="#">ЕЩЁ</a></span></h5>
            <div class="row">
                <div class="col s4">
                    <div class="mc">
                        <div class="header">Floral Refresh</div>
                        <div class="subheader"></div>
                        <img src="images/f4.jpg">
                    </div>
                </div>
                <div class="col s4">
                    <div class="mc">
                        <div class="header">Pre-Fakk New Arrival</div>
                        <div class="subheader"></div>
                        <img src="images/f3.jpg">
                    </div>
                </div>
                <div class="col s4">
                    <div class="mc">
                        <div class="header">Женские часы</div>
                        <div class="subheader"></div>
                        <img src="images/f2.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tab_like" class="col s12" style="padding: 0;">
        <div class="row">
            <?php
                if (count($newProducts)){
                    foreach ($newProducts as $product){
                        ?>
                            <div class="col s6">
                                <a href="<?= Yii::$app->urlManager->createUrl(['/products/view', 'id' => $product->id]) ?>">
                                    <div class="mc">
                                        <?= Html::img('images/products/'.$product->onlypic->path) ?>
                                        <div class="header">US $<?= $product->price ?></div>
                                        <div class="subheader"></div>
                                    </div>
                                </a>
                            </div>
                        <?php
                    }
                }
                else {
                    echo "<h5>No Products</h5>";
                }
            ?>
        </div>
    </div>
</div>

