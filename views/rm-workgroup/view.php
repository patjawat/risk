<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var risk\models\RmWorkgroup $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Workgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-workgroup-view">
  <p>
  <?php echo Html::a('<i class="glyphicon glyphicon-step-backward"></i> หน้าหลัก', ['index'], ['class' => 'btn btn-primary']) ?>&nbsp
  <?php echo Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่ม', ['create'], ['class' => 'btn btn-success']) ?>
  </p>
    <?= DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'id',
            'name',
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->id],
        ],
        'enableEditMode' => true,
    ]) ?>

</div>
