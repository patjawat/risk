<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\TranscribingItems */

$this->title = $model->transcribing_error_id;
$this->params['breadcrumbs'][] = ['label' => 'Transcribing Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transcribing-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'transcribing_error_id' => $model->transcribing_error_id, 'drug_items_id' => $model->drug_items_id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'transcribing_error_id' => $model->transcribing_error_id, 'drug_items_id' => $model->drug_items_id, 'id' => $model->id], [
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
            'transcribing_error_id',
            'drug_items_id',
            'details',
            'rm_event_id',
            'id',
            'lasa',
        ],
    ]) ?>

</div>
