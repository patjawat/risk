<?php

use kartik\helpers\Html;

/**
 * @var yii\web\View $this
 * @var risk\models\RmGroup $model
 */

$this->title = 'เพิ่มโปรแกรมความเสี่ยง';
$this->params['breadcrumbs'][] = ['label' => 'โปรแกรมความเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-group-create">
  <p>
  <?php echo Html::a('<i class="glyphicon glyphicon-step-backward"></i> หน้าหลัก', ['index'], ['class' => 'btn btn-primary']) ?>&nbsp
  <?php //echo Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่ม', ['create'], ['class' => 'btn btn-success']) ?>
  </p>
  <?= Html::panel(
      ['heading' => 'แบบฟอร์อมการ'.$this->title, 'body' => '<div class="panel-body">'  .   $this->render('_form', [
               'model' => $model,
           ]).'</div>'],
      Html::TYPE_INFO
  );?>
</div>
