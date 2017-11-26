<?php
/**
 * Created by PhpStorm.
 * User: vipsh
 * Date: 23.11.2017
 * Time: 20:40
 */

use yii\helpers\Html;

$this->title = "Адрес доставки | Настройки";
?>

<a href="<?= Yii::$app->urlManager->createUrl(['/site/settings']) ?>" class="canback z-depth-1">
    <i class='material-icons'>chevron_left</i>
    <div class="title">Настройки</div>
</a>

<?php
    if (count($addresses)){
        echo Html::beginForm(['/site/settings']);
        ?>
        <div class="mc">
            <ul class="list">
                <?php
                $i = -1;
                foreach ($addresses as $address){
                    $i++;
                    ?>
                    <li class="pad5">
                        <input type="radio" name="default_address" class="with-gap" value="<?= $address->id ?>" id="address_<?= $i ?>" <?= $address->dflt == 1 ? "checked" : "" ?>>
                        <label for="address_<?= $i ?>">
                            <?= $address->state.', '.$address->apartment.', '.$address->street.', '.$address->postcode ?>
                        </label>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div align="right">
            <button class="btn" style="margin: 5px">Сохранить</button>
        </div>
        <?php
        echo Html::endForm();
    }
    else {
        echo "no addresses entered";
    }
?>

<div class="fixed-action-btn vertical click-to-toggle">
    <a class="btn-floating btn-large">
        <i class="material-icons">menu</i>
    </a>
    <ul>
        <li>
            <?= Html::a("<i class='material-icons'>add</i>", ['/site/settings', 'action' => 'add_address'], ['class' => 'btn-floating green']) ?>
        </li>
        <li>
            <?= Html::a("<i class='material-icons'>delete</i>", ['/site/settings', 'action' => 'delete_address'], ['class' => 'btn-floating red go_action']) ?>
        </li>
    </ul>
</div>


<script>
    $(document).ready(function() {
        $href = $('.go_action').attr('href');
        $('input[type="radio"]').click(function() {
            $val = $(this).val();

            $('.go_action').attr('href', $href + '&id='+$val);
        });
    });
</script>