<?php
/**
 * Created by PhpStorm.
 * User: vipsh
 * Date: 26.11.2017
 * Time: 20:45
 */
use yii\helpers\Html;

$this->title = "Адрес доставки | Настройки";
?>

<a href="<?= Yii::$app->urlManager->createUrl(['/site/settings', 'action' => 'delivery_address']) ?>" class="canback z-depth-1">
    <i class='material-icons'>chevron_left</i>
    <div class="title">Адрес доставки</div>
</a>

<?= Html::beginForm(['/site/settings', 'action' => 'delivery_address']) ?>

<?= Html::endForm() ?>
