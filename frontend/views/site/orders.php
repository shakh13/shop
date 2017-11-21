<?php
/**
 * Created by PhpStorm.
 * User: shaxzod
 * Date: 8/19/17
 * Time: 1:00 PM
 */

$this->title = "Мои заказы";

if (count($orders)){

}
else {
    ?>
    <div style="background-color: #FFF; padding: 15px; color: #555; text-align: center"><h3>Ничего не заказано.</h3></div>
    <?php
}
?>