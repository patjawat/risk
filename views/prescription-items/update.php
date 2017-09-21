<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\PrescriptionItems */

$this->title = 'Update Prescription Items: ' . $model->prescription_error_id;
$this->params['breadcrumbs'][] = ['label' => 'Prescription Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prescription_error_id, 'url' => ['view', 'prescription_error_id' => $model->prescription_error_id, 'drug_items_id' => $model->drug_items_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prescription-items-update">
    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
