<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
// use yii\bootstrap\ActiveForm;
use kartik\form\ActiveForm;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use risk\models\RmType;
use risk\models\RmGroup;
use yac\ajaxModal\ajaxModal;
use yii\bootstrap\Modal;
use \yii2assets\printthis\PrintThis;
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
        'id' => 'search-form',
        // 'type' => ActiveForm::TYPE_INLINE,
        //'action' => ['pdf-export'],
        'method' => 'get',
        'options' => ['data-pjax' => true ]

    ]);?>
    <div class="row">
      <div class="col-md-4">
        <?=$form->field($model, 'date1')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
             'ajaxConversion'=>true,
        ]);
         ?>
      </div>
      <div class="col-md-4">
        <?=$form->field($model, 'date2')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
             'ajaxConversion'=>true,
        ]);
      ?>
      </div>

      <div class="col-md-4">
        <div class="input-group" style="margin-top:25px;">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
              <?php
              echo PrintThis::widget([
                  'htmlOptions' => [
                      'id' => 'PrintThis',
                      'btnClass' => 'btn btn-info',
                      'btnId' => 'btnPrintThis',
                      'btnText' => 'พิมพ์หน้านี้',
                      'btnIcon' => 'fa fa-print'
                  ],
                  'options' => [
                      'debug' => false,
                      'importCSS' => true,
                      'importStyle' => true,
                      'loadCSS' => "@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css",
                      'pageTitle' => 'รายงานความเสี่ยง',//'<p class="p-title">รายการอุบัติการณ์/ความเสี่ยง<br>โรงพยาบาลโนนสัง จังหวัดหนองบัวลำภู ปีงบประมาณ  2560 </p>',
                      'removeInline' => false,
                      'printDelay' => 333,
                      'header' => Html::img('@web/images/gpo.png',['width' => 80,'class' => 'logo-header','style' =>'margin-left:45%;']).'<p style="text-align: center;">รายการอุบัติการณ์/ความเสี่ยง<br>โรงพยาบาลโนนสัง จังหวัดหนองบัวลำภู ปีงบประมาณ  2560 </p>',
                      'formValues' => true,
                  ]
              ]);
              ?>
              <?php //echo Html::button('hello',['class' => 'btn btn-primary','id' => 'pdf']); ?>
              <?php // Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>

            </span>
          </div>
      </div>
    </div>
<!-- <div class="form-group"> -->
<div class="row">
  <div class="col-md-4">
    <?php
    // Normal select with ActiveForm & model
   $form->field($model, 'rm_type_id')->widget(Select2::classname(), [
      'data' => ArrayHelper::map(RmType::find()->all(), 'id','name'),
      'language' => 'th',
      'options' => ['placeholder' => 'Enter...ประเถทความเสี่ยง',
      'id' => 'rm_type_id'],
      'pluginOptions' => [
        'allowClear' => true
      ],
    ]);?>
  </div>
  <div class="col-md-6">
    <?php
    // Normal select with ActiveForm & model
   $form->field($model, 'multigroup')->widget(Select2::classname(), [
      'data' => ArrayHelper::map(RmGroup::find()->all(), 'id','name'),
      'language' => 'th',
      'options' => ['placeholder' => 'Enter...โปรแกรมความเสี่ยง',
      'id' => 'rm_group_id'],
      'pluginOptions' => [
        'allowClear' => true,
        'multiple' => true
      ],
    ]);
    ?>
  </div>
</div>
<div class="row">
  <div class="col-md-2">

  </div>
</div>
  <!-- </div> -->

  <?php ActiveForm::end(); ?></div>
