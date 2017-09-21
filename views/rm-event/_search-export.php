<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
// use yii\bootstrap\ActiveForm;
use kartik\form\ActiveForm;
use kartik\datecontrol\DateControl;
?>
<style media="screen">
.form-group {
  margin-bottom: 0px;
}
.help-block {
    display: block;
    margin-top: 2px;
    margin-bottom: 3px;
    color: #737373;
}
</style>
<div class="rm-event-search">
   <?php $form = ActiveForm::begin([
        'id' => 'login-form-inline',
        'type' => ActiveForm::TYPE_INLINE
    ]);?>
<div class="form-group">
  <?=$form->field($model, 'date1')->widget(DateControl::classname(), [
      'type'=>DateControl::FORMAT_DATE,
       'ajaxConversion'=>true,
  ]);
   ?>
  <?=$form->field($model, 'date2')->widget(DateControl::classname(), [
      'type'=>DateControl::FORMAT_DATE,
       'ajaxConversion'=>true,
  ]);
?>
  </div>
  <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app', 'บันทึกความเสี่ยง'), ['/rm/rm-event/create'], ['class' => 'btn btn-success']) ?>
      </span>
    </div>
  <?php ActiveForm::end(); ?></div>
