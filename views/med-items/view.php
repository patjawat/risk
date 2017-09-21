<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\MedItems */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Med Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="med-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('เพิ่ม', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
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
            'med_type_id',
            'name',
        ],
    ]) ?>

</div>
