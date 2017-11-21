<?php
/**
 * Created by PhpStorm.
 * User: shaxzod
 * Date: 8/20/17
 * Time: 12:11 PM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = "Добавить новый товар";
?>

<?= Html::a('Менеджер товара', ['index']) ?> &raquo; <?= Html::a($this->title, ['create']) ?>
<br>
<br>
    <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    ?>

    <?= $form->field($model, 'content') ?>
    <div class="row">
        <div class="col m4">
            <?= $form->field($model, 'price')->input('number') ?>
        </div>
        <div class="col m4">
            <?= $form->field($model, 'discount')->input('number') ?>
        </div>
        <div class="col m4">
            <?= $form->field($model, 'discount_from_count')->input('number') ?>
        </div>
    </div>
    <?php
        $shops_arr = ArrayHelper::map($shops, 'id', 'name');
        $categories_arr = ArrayHelper::map($categories, 'id', 'content');

        echo $form->field($model, 'shop_id')->dropDownList($shops_arr, ['style' => 'display: block']);
        echo $form->field($model, 'category_id')->dropDownList($categories_arr, ['style' => 'display: block']);
    ?>

    <h5>Описание</h5>
    <div class="row card">
        <div class="col m11">
            <select id="desc_select" style="display: block">
                <?php
                foreach ($descs as $desc)
                    echo "<option value='".$desc->id."'>".$desc->content."</option>"
                ?>
            </select>
        </div>
        <div class="col m1">
            <a href="#" class="btn btn-floating" id="desc_add">+</a>
        </div>
        <div class="col m12" id="descriptions">
            <input type="hidden" name="Products[description]">

        </div>
    </div>


    <h5>Изображение</h5>

    <div class="row">
        <div class="file-field input-field">
            <div class="btn">
                <span>Для рекламы</span>
                <input type="file" name="Products[photo][reklama]">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>

        <div class="col m12 card">
            <h6>Для просмотра<a href="#" id="add_p_show" class="btn btn-floating right">+</a></h6>
            <div id="photos_show">
                <div class="row p3 p_sh_0">
                    <input type="file" class="col m11" name="Products[photo][sh_0]">
                </div>
            </div>
        </div>
        <div class="col m12 card">
            <h6>Для выбора цвет<a href="#" id="add_p_color" class="btn btn-floating right">+</a></h6>
            <input type="hidden" name="Products[p_color]">
            <div id="photos_color">
                <!--
                <div class="row p_c_0">
                    <div class="col m6"><input type="file" name="Products[photo][c_0][file]"></div>
                        <div class="col m6"><input type="text" name="Products[photo][c_0][content]" placeholder="Content"></div>
                </div>
                -->
            </div>
        </div>
        <!--<input type="file" name="Products[photo][sh_0]"><!-- to show -->
        <!--<input type="file" name="Products[photo][c_0]"><!-- to select color -->
    </div>

    <div class="card">
        <br>
        <h5>&nbsp;Размер <a hre="#" id="p_size_add" class="btn btn-floating right">+</a></h5>
        <br>
        <div id="p_sizes" class="row">

        </div>
    </div>

    <?= $form->field($model, 'tags') ?>
    <?= $form->field($model, 'quantity')->input('number') ?>

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn']) ?>
    <?php
        ActiveForm::end();
    ?>