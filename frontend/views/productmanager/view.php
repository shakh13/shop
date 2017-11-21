<?php
/**
 * Created by PhpStorm.
 * User: shakh
 * Date: 25.08.17
 * Time: 13:54
 */

use yii\helpers\Html;

$this->title = "Просмотр";
?>

<?php
    if ($product){
        ?>
            <h5><?= $product->content ?></h5>
            <div class="row">
                <div class="col s3"><b>Price</b></div>
                <div class="col s9"><?= $product->price ?></div>
                <div class="col s3"><b>Discount</b></div>
                <div class="col s9"><?= $product->discount ?>% off after buying <?= $product->discount_from_count ?></div>
                <div class="col s3"><b>Shop</b></div>
                <div class="col s9"><?= Html::a($product->shop->name, ['/shop', 'id' => $product->shop_id]) ?></div>
                <div class="col s3"><b>Category</b></div>
                <div class="col s9"><?= $product->category->content ?></div>
                <div class="col s3"><b>Description</b></div>
                <div class="col s9">
                    <?php
                        $descriptions = $product->descriptions->parse;
                        echo "<div class='row'>";
                        foreach ($descriptions as $description){
                            echo "<div class='col s4'>".$description->description->content."</div><div class='col s8'>".$description->content."</div>";
                        }
                        echo "</div>";
                    ?>
                </div>
                <div class="col s3"><b>Tags</b></div>
                <div class="col s9"><?= $product->tags ?></div>
                <div class="col s3"><b>Quantity</b></div>
                <div class="col s9"><?= $product->quantity // chanta mondagesha hisob kadan darkor **************** ?></div>
                <div class="col s3"><b>Sizes</b></div>
                <div class="col s9">
                    <?php
                        $sizes = $product->sizes;
                        foreach ($sizes as $size){
                            echo $size->content."<br>";
                        }
                    ?>
                </div>
                <div class="col s3"><b>Colors</b></div>
                <div class="col s9">
                    <?php
                        $colors = $product->colors;
                        echo "<div class='row'>";
                        foreach ($colors as $color){
                            echo "<div class='col s4'>".$color->color."</div><div class='col s8'>".Html::img('images/products/'.$color->path, ['width' => '100'])."</div>";
                        }
                        echo "</div>";
                    ?>
                </div>
                <div class="col s3"><b>Photos</b></div>
                <div class="col s9">
                    <?php
                    $photos = $product->photos;
                    foreach ($photos as $photo){
                        echo Html::img('images/products/'.$photo->path, ['width' => '100%']);
                    }
                    ?>
                </div>
                <div class="col s3"><b>Reklama photo</b></div>
                <div class="col s9"><?= Html::img('images/products/'.$product->reklamaphoto->path, ['width' => '100%'])?></div>
            </div>
        <?php
    }
    else {
        echo "Product not found";
    }
?>
