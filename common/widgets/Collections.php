<?php
/**
 * Created by PhpStorm.
 * User: Shaxzod
 * Date: 18.08.2017
 * Time: 9:02
 */

namespace common\widgets;


use Yii;
use yii\helpers\Html;
class Collections
{
    public static function doit($collections){
        echo "<div class='collections'>";
        foreach ($collections as $collection){
            if ($collection['url'] == 'divider')
            {
                echo "<div class='divider'></div>";
            }
            else {
                $action = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
                $b = "<i class='material-icons'>".$collection['icon']."</i>";
                $b .= "<div class='content'>".$collection['content']."</div>";
                echo Html::a($b, $collection['url'], ($collection['url'][0] == $action) || ($collection['url'][0] == "/".$action) ? ['class' =>  'active'] : []);
            }
        }
        echo "</div>";
    }
}