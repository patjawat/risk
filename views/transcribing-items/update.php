<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\TranscribingItems */

$this->title = 'Update Transcribing Items: ' . $model->transcribing_error_id;
$this->params['breadcrumbs'][] = ['label' => 'Transcribing Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transcribing_error_id, 'url' => ['view', 'transcribing_error_id' => $model->transcribing_error_id, 'drug_items_id' => $model->drug_items_id, 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transcribing-items-update">
    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
