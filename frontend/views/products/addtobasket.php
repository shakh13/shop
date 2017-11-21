<?php
/**
 * Created by PhpStorm.
 * User: shakh
 * Date: 29.09.17
 * Time: 11:01
 */

use yii\helpers\Html;

$this->title = "Корзина";
?>



<div class="mc" style="padding: 10px;">
    <div class="product_img">
        <?= Html::img('images/products/'.$product->onlypic->path) ?>
    </div>
    <div class="product_content">
        <?= $product->content ?>
    </div>
    <?php
        if ($product->discount > 0){
            ?>
                <div class="discount"><?= $product->discount.'% скидка от '.$product->discount_from_count.' шт' ?></div>
            <?php
        }
    ?>
</div>

<?php
    if ($msg){
        if ($msg['status'] == 'success'){
            ?>
                <div class="mc blue darken-3 white-text pad5">
                    <?= $msg['content'] ?>
                </div>
            <?php
        }
        else {
            ?>
                <div class="mc red white-text pad5">
                    <?= $msg['content'] ?>
                </div>
            <?php
        }
    }
?>

<?= Html::beginForm() ?>

<?php
    if ($product->colors) {
        ?>
                <div class="mc p3" id="colors" style="margin-top: 5px; padding: 5px 10px 15px 10px;">

                    <h5>Цвет</h5>
                    <?php
                        $i = 0;
                        foreach ($product->colors as $color){
                            ?>
                            <p>
                                <input class="with-gap" name="Basket[p_photo_id]" type="radio" value="<?= $color->id ?>" id="color_<?= $color->id
                                ?>"
                                    <?= $i ==
                                0 ? "checked    " : "" ?>/>
                                <label for="color_<?= $color->id ?>">
                                    <?= Html::img('images/products/'.$color->path) ?>
                                    <span class="content"><?= $color->color ?></span>
                                </label>
                            </p>
                            <?php
                            $i++;
                        }
                    ?>
                </div>
        <?php
    }

    if ($product->sizes){
        ?>
                <div class="mc p3" style="margin-top: 5px; padding: 5px 10px 15px 10px;">
                    <h5>Размер</h5>
                    <?php
                        $i = 0;
                        foreach ($product->sizes as $size){
                            ?>
                                    <input class="with-gap" name="Basket[p_size_id]" type="radio" id="size_<?= $size->id ?>" value="<?= $size->id ?>"
                                        <?= $i ==
                                    0 ? "checked" : "" ?>/>
                                    <label for="size_<?= $size->id ?>"><?= $size->content ?></label>
                                    &nbsp;&nbsp;&nbsp;
                            <?php
                            $i++;
                        }
                    ?>
                </div>
        <?php
    }
?>

<input type="hidden" name="price" value="<?= $product->price ?>">
<input type="hidden" name="discount" value="<?= $product->discount ?>">
<input type="hidden" name="dfc" value="<?= $product->discount_from_count ?>">


    <div class="mc row p3" style="margin-top: 5px; padding: 5px 10px 15px 10px;">
        <h5>Цена</h5>
        <div class="col s4">
            <div class="countcountrol">
                <div class="minus">-</div>
                <div class="count">1</div>
                <div class="plus">+</div>
            </div>
            <input type="hidden" name="Basket[count]" value="1">
        </div>
        <div class="col s8" align="right"><b>US $<span class="price"><?= $product->price ?></span></b></div>
    </div>

<div align="right" style="padding: 10px;">
    <?= Html::submitButton('В корзину', ['class' => 'btn blue darken-3']) ?>
</div>
<?= Html::endForm() ?>

<div class="mc pad5">
    <?= Html::a("&laquo; Главная страница", ['/site']).' '.Html::a("&laquo; Товар", ['/products/view', 'id' => $product->id]) ?>
</div>
