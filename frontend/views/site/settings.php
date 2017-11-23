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
                Html::a("Валюта: <span class='badge'>".($user->profile->currency ? $user->profile->currency : 'UZS')."</span>" , [
                    '/site/settings',
                    'action' => 'currency'
                ])
            ?>
        </li>
    </ul>
</div>
