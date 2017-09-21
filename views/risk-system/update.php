<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\RiskSystem */

$this->title = 'แก้ไข: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Risk Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="risk-system-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
