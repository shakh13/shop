<?php
/**
 * Created by PhpStorm.
 * User: vipsh
 * Date: 23.11.2017
 * Time: 18:38
 */

use yii\helpers\Html;

$this->title = "Настройки";

?>

<h5 class="bold pad5"><?= $this->title ?></h5>

<div class="mc pad5">
    <h6>Настройки профилья</h6>

    <ul class="list">
        <li class="pad5">
            <?=
                Html::a(
                    "Адрес доставки: <span class='badge'>".($user->defaultaddress ? $user->defaultaddress->street : 'Неизвестно')."</span>",
                    ['/site/settings', 'action' => 'delivery_address']
                )
            ?>
        </li>
        <li class="pad5">
            <?=
                Html::a("Валюта: <span class='badge'>".Yii::$app->currency($user->profile->currency)."</span>" , [
                    '/site/settings',
                    'action' => 'currency'
                ])
            ?>
        </li>
        <li class="pad5">
            <?=
                Html::a("Язык: <span class='badge'>".Yii::$app->language($user->profile->lng)."</span>", [
                        '/site/settings',
                        'action' => 'language'
                    ])
            ?>
        </li>
    </ul>
</div>

<div class="mc pad5" style="margin-top: 7px;">
    <ul class="list">
        <li class="pad5">
            <?= Html::a("Мои предпочтения", ['/site/settings', 'action' => 'preferences']) ?>
        </li>
        <li class="pad5">
            <?= Html::a("Настройка уведомлений", ['/site/settings', 'action' => 'notifications']) ?>
        </li>
    </ul>
</div>

<div class="mc pad5" style="margin-top: 7px;">
    <ul class="list">
        <li class="pad5">
            <?= Html::a("Конвертер валют", ['/site/settings', 'action' => 'currency_converter']) ?>
        </li>
        <li class="pad5">
            <?= Html::a("Политика конфиденциальности", ['/site/settings', 'action' => 'privacy_policy']) ?>
        </li>
    </ul>
</div>