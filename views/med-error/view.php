<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\MedError */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Med Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="med-error-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'rm_event_id',
            'med_items_id',
            'med_type_id',
            'med_employee_id',
            'lasa',
            'note:ntext',
        ],
    ]) ?>

</div>
