<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\DrugItems */

$this->title = 'Update Drug Items: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Drug Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="drug-items-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
