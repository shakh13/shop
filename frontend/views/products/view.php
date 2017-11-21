<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.08.2017
 * Time: 15:41
 */

use yii\helpers\Html;

$this->title = "Товар";


$productPhotos = $product->photos;
?>
<div class="product">
    <div class="slider" data-indicator="false">
        <ul class="slides">
            <?php
                if (count($productPhotos)){
                    foreach ($productPhotos as $photo){
                        ?>
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl('#id='.$photo->id) ?>">
                                <img src="images/products/<?= $photo->path ?>">
                            </a>
                        </li>
                        <?php
                    }
                }
            ?>
        </ul>
    </div>
    <div class="content">
        <div class="subcontent">
            US $<?= $product->price ?>
        </div>
        <div class="icon">
            <?php
                $fav = \app\models\Favorites::findOne(['user_id' => Yii::$app->user->id, 'product_id' => $product->id]);
            ?>
            <a href="#favorites" class="<?= $fav ? 'selected' : '' ?>" data-id="<?= $product->id ?>"><i class="material-icons">favorite</i></a>
        </div>
        <?= $product->content ?>
    </div>

    <?php
        $msg = Yii::$app->request->getQueryParam('content');
        if ($msg){
            ?>
                <div class="mc blue darken-3 white-text">
                    <?= $msg ?>
                </div>
            <?php
        }
    ?>

    <div class="basket" align="right">
        <?= Html::a("<i class='material-icons left'>shopping_cart</i>В корзину", ['/products/addtobasket', 'product_id' => $product->id],
            ['class' => 'btn grey']) ?>
        <?= Html::a("Купить сейчас", ['/products/buy', 'product_id' => $product->id], ['class' => 'btn red']) ?>
    </div>

    <?= $product->discount > 0 ? "<div class='discount'>Скидка ".$product->discount."% от ".$product->discount_from_count."</div>" : "" ?>

    <?php
        if ($product->descriptions){
            ?>
                <table class="bordered highlight white">
                    <thead>
                        <tr>
                            <th>Описание товара</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                        foreach ($product->descriptions->parse as $description){
                            echo "<tr><td>".$description->description->content."</td><td>".$description->content."</td></tr>";
                        }
                    ?>
                </table>
            <?php
        }
    ?>

    <h5 class="light bold pad5">Комментарий</h5>
    <div class="comments white">
        <div class="comment pad5">

            <?php
                if (count($product->comments)){
                    ?>
                        <ul class="collection">
                            <?php
                                foreach ($product->comments as $comment){
                                    ?>
                                        <li class="collection-item avatar">
                                            <img src="images/<?= $comment->user->profile->img_path ? 'profile/'.$comment->user->profile->img_path :
                                                'no.png' ?>"
                                                 alt=""
                                                 class="circle">
                                            <span class="title"><?= Html::a($comment->user->profile->name) ?></span>
                                            <p><?= $comment->content ?></p>
                                            <label class="secondary-content"><?= Yii::$app->prettyDate($comment->created_at) ?></label>
                                        </li>
                                    <?php
                                }
                            ?>
                        </ul>
                    <?php
                }
                else {
                    echo "Нет комментарий.";
                }
            ?>

        </div>
        <div class="write pad5">
            <?php
                if (Yii::$app->user->isGuest){
                    echo "<span>Чтобы оставить комментарий вы должны <a href='".Yii::$app->urlManager->createUrl(['/site/login'])."'>авторизоваться.</a></span>";
                }
                else {

                    $basket = \app\models\Basket::find()->where(['user_id' => Yii::$app->user->id, 'product_id' => $product->id, 'status' => 2])
                        ->all();

                    if ($basket){

                        echo Html::beginForm(['/products/sendcomment', '_retUrl' => Yii::$app->request->absoluteUrl]);
                        echo Html::hiddenInput('product', $product->id);

                        //  send photo with comment
                        // ***********************************************************************************************

                        ?>
                            <input type="text" placeholder="Комментарий" name="comment">
                            <button id="sendComment"><i class="material-icons">send</i></button>
                        <?php
                        echo Html::endForm();
                    }
                    else {
                        echo "<span> Чтобы оставить комментарий вы должны покупать этот товар</span>";
                    }
                }
            ?>
        </div>
    </div>
</div>