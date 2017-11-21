<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Descs */

$this->title = 'Create Descs';
$this->params['breadcrumbs'][] = ['label' => 'Descs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="descs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
