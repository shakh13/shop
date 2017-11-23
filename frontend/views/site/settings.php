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
        <li>
            <?=
                Html::a(
                    "Адрес доставки: <span class='badge'>".($user->defaultaddress ? $user->defaultaddress->street : 'Неизвестно')."</span>",
                    ['/site/settings', 'action' => 'delivery_address']
                )
            ?>
        </li>
    </ul>
</div>
