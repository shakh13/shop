<?php
/**
 * Created by PhpStorm.
 * User: vipsh
 * Date: 26.11.2017
 * Time: 20:45
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = "Адрес доставки | Настройки";
?>

<a href="<?= Yii::$app->urlManager->createUrl(['/site/settings', 'action' => 'delivery_address']) ?>" class="canback z-depth-1">
    <i class='material-icons'>chevron_left</i>
    <div class="title">Адрес доставки</div>
</a>

<div class="mc" style="padding: 15px">
    <?php
        $form = ActiveForm::begin(['action' => ['/site/settings', 'action' => 'delivery_address']]);
        $city = ArrayHelper::map($cities, 'id', 'content');
    ?>
        <?= $form->field($model, 'contact_name') ?>
        <?= $form->field($model, 'phone_number') ?>
        <?= $form->field($model, 'city_id')->dropDownList($city, ['style' => 'display:block']) ?>
        <?= $form->field($model, 'street') ?>
        <?= $form->field($model, 'apartment') ?>
        <?= $form->field($model, 'postcode') ?>

        <button class="btn">Сохранить</button>
    <?php
        ActiveForm::end();
    ?>
</div>
