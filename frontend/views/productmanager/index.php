<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = "Менеджер товара";
?>

<h3><?= Html::a('Менеджер товара', ['index']) ?></h3>
<?= Html::a('Добавить новый товар', ['create'], ['class' => 'btn']) ?>

<?php
    if (count($products)){
        echo "<br><br><div class='row'>";
        foreach ($products as $product){
            // continue ****************************************************
            echo "<div class='col s2'>".Html::img('images/products/'.$product->onlypic->path, ['width' => 100])."</div>";
            echo "<div class='col s10'><h5>".Html::a($product->content, ['view', 'id' => $product->id])."</h5></div>";
        }
        echo "</div>";
    }
    else {
        echo "<h4>Товар ещё не добавлено</h4>";
    }
?>
