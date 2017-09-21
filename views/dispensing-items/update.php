<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\DispensingItems */

$this->title = 'Update Dispensing Items: ' . $model->dispensing_error_id;
$this->params['breadcrumbs'][] = ['label' => 'Dispensing Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dispensing_error_id, 'url' => ['view', 'dispensing_error_id' => $model->dispensing_error_id, 'drug_items_id' => $model->drug_items_id, 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dispensing-items-update">

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
