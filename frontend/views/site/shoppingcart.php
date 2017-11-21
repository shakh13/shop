<?php
/**
 * Created by PhpStorm.
 * User: shaxzod
 * Date: 8/19/17
 * Time: 8:47 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Корзина";

?>

<ul class="collection" id="mybasket">
    <?php
        if ($basket){

            $form = ActiveForm::begin();

            foreach ($basket as $bas){
                ?>
                    <li class="collection-item avatar" data-id="<?= $bas->id ?>" style="margin-bottom: 5px;">
                        <label for="chb_<?= $bas->id ?>" data-id="<?= $bas->id ?>">
                            <img src="images/products/<?= $bas->color ? $bas->color->path : $bas->product->onlypic->path ?>" class="circle square">
                            <input type="checkbox" name="Basket[<?= $bas->id?>]" id="chb_<?= $bas->id ?>" class="basket_check" data-id="<?= $bas->product_id ?>" />
                        </label>
                        <span class="title"><?= Html::a(Yii::$app->maxWord($bas->product->content, 60), ['/products/view', 'id' => $bas->product_id]) ?></span>
                        <p style="text-align: right">
                            <table>
                                <tbody>
                                    <?php
                                        if ($bas->color){
                                            ?>
                                                <tr>
                                                    <td>Цвет</td>
                                                    <td><?= $bas->color->color ?></td>
                                                </tr>
                                            <?php
                                        }

                                        if ($bas->size){
                                            ?>
                                            <tr>
                                                <td>Размер</td>
                                                <td><?= $bas->size->content ?></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    <tr>
                                        <td>Количество</td>
                                        <td><?= $bas->count ?></td>
                                    </tr>
                                    <tr>
                                        <td>Скидка</td>
                                        <td><?= $bas->product->discount.' % от '.$bas->product->discount_from_count ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Общая сумма
                                        </td>
                                        <td>
                                            $<?= Yii::$app->calculate($bas->product->price, $bas->count, $bas->product->discount, $bas->product->discount_from_count) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </p>
                    </li>
                <?php
            }
            ?>
                <div class="pad5" align="right">
                    <?= Html::submitButton("Купить", ['class' => 'btn blue darken-3 waves-effect waves-light']) ?>
                    <?= Html::a('<i class="material-icons">delete_sweep</i>', '#deleteFromBasket', ['class' => 'btn-floating waves-effect waves-light red']) ?>
                </div>
            <?php
            ActiveForm::end();
        }
        else {
            echo "Sorry. Your basket is empty";
        }
    ?>
</ul>