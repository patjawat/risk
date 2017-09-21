<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use risk\models\RmType;
use risk\models\RmGroup;
use risk\models\RmWorkgroup;
use risk\models\SpecificClinical;
?>

<div class="rm-items-form">
    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_SMALL]
  ]); echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
          'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter...ระบุบชื่อความเสี่ยง...', 'maxlength' => 255]],
            //'rm_group_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ระบุบชื่อโปรแกรมความเสี่ยง...', 'maxlength' => 5]],
            'rm_type_id' => [
              //'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter แผนก-ฝ่าย...', 'maxlength' => 50]
              'type'=>Form::INPUT_WIDGET,
              'widgetClass'=>'\kartik\widgets\Select2',
              'options'=>['data'=>ArrayHelper::map(RmType::find()->all(), 'id','name'),
              'options' => ['placeholder' => 'Enter...ประเภทความเสี่ยง',],],
              ],
            'rm_group_id' => [
              //'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter แผนก-ฝ่าย...', 'maxlength' => 50]
              'type'=>Form::INPUT_WIDGET,
              'widgetClass'=>'\kartik\widgets\Select2',
              'options'=>['data'=>ArrayHelper::map(RmGroup::find()->select(['id,concat("[",id,"] - ",name) as name'])->all(), 'id','name'),
              'options' => ['placeholder' => 'Enter...โปรแกรมความเสี่ยง...',],],
              ],
              'rm_workgroup_id' => [
                //'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter แผนก-ฝ่าย...', 'maxlength' => 50]
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>['data'=>ArrayHelper::map(RmWorkgroup::find()->select(['id,concat("[",id,"] - ",name) as name'])->all(), 'id','name'),
                'options' => ['placeholder' => 'Enter...ทีมคล่อม',],],
                ],
                'specific_clinical_id' => [
                  //'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter แผนก-ฝ่าย...', 'maxlength' => 50]
                  'type'=>Form::INPUT_WIDGET,
                  'widgetClass'=>'\kartik\widgets\Select2',
                  'options'=>['data'=>ArrayHelper::map(SpecificClinical::find()->all(), 'id','name'),
                  'options' => ['placeholder' => 'Enter...คลินิกเฉพาะทาง'],],
                  ],


            //'rm_type_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ประเภท...', 'maxlength' => 10]],

            //'specific_clinical_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter คลินิกเฉพาะทาง...', 'maxlength' => 50]],

        ]

    ]);

    ActiveForm::end(); ?>

</div>
