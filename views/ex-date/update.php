<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\ExDate */

$this->title = 'Update Ex Date: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ex Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ex-date-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data
    ]) ?>

</div>
