<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\AdministrationItems */

$this->title = $model->administration_error_id;
$this->params['breadcrumbs'][] = ['label' => 'Administration Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administration-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'administration_error_id' => $model->administration_error_id, 'drug_items_id' => $model->drug_items_id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'administration_error_id' => $model->administration_error_id, 'drug_items_id' => $model->drug_items_id, 'id' => $model->id], [
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
            'administration_error_id',
            'drug_items_id',
            'details',
            'lasa:ntext',
            'rm_event_id',
            'id',
        ],
    ]) ?>

</div>
