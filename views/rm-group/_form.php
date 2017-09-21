<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use risk\models\RmWorkgroup;
?>
<div class="rm-group-form">
    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รหัส...', 'maxlength' => 5]],
          //  'rm_workgroup_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter กลุ่มงานที่ได้รับมอบหมาย...', 'maxlength' => 5]],
          'rm_workgroup_id' => [
            //'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter แผนก-ฝ่าย...', 'maxlength' => 50]
            'type'=>Form::INPUT_WIDGET,
            'widgetClass'=>'\kartik\widgets\Select2',
            'options'=>['data'=>ArrayHelper::map(RmWorkgroup::find()->select(['id,concat("[",id,"] - ",name) as name'])->all(), 'id','name'),
            'options' => ['placeholder' => 'Enter...ชื่อแผนก',],],
            ],
            'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ชื่อโปรแกรม...', 'maxlength' => 100]],

            'discription' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ความหมาย...', 'maxlength' => 255]],

        ]

    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'บันทึก') : Yii::t('app', 'แก้ไข'),
        ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary glyphicon glyphicon-ok']
    );
    ActiveForm::end(); ?>

</div>
