<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\RiskSystem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Risk Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-system-view">
  <?php \yiister\adminlte\widgets\Box::begin(
              [
                  "header" => "#เนื้อหาเกี่ยวกับระบบ",
                  "type" => \yiister\adminlte\widgets\Box::TYPE_SUCCESS,
                  "removable" => true,
              ])
          ?>
    <p>
        <?= Html::a('<i class="fa fa-floppy-o" aria-hidden="true"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> ลบข้อมูล', ['delete', 'id' => $model->id], [
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
            'name',
            'content:html',
        ],
    ]) ?>
 <?php \yiister\adminlte\widgets\Box::end() ?>
</div>
