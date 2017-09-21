<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\PrescriptionItems */

$this->title = $model->prescription_error_id;
$this->params['breadcrumbs'][] = ['label' => 'Prescription Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prescription-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'prescription_error_id' => $model->prescription_error_id, 'drug_items_id' => $model->drug_items_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'prescription_error_id' => $model->prescription_error_id, 'drug_items_id' => $model->drug_items_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'prescription_error_id',
            'drug_items_id',
            'details',
            'lasa:ntext',
            'rm_event_id',
        ],
    ]) ?>

</div>
