<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\RmLevelgroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Levelgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-levelgroup-view">

  <p id="action">
    <?= Html::button('แก้ไข', [
      'value' => yii\helpers\Url::to(['/rm/rm-levelgroup/update',
      'id' => $model->id
    ]),
      'title' => $this->title,
      'class' => 'showModalButton btn btn-success glyphicon glyphicon-edit']); ?>
      <a href="#" class="btn btn-danger glyphicon glyphicon-off"  data-dismiss="modal";>ปิด</a>
  </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'color',
        ],
    ]) ?>

</div>
