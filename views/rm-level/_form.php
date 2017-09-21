<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use risk\models\RmLevelgroup;

?>

<div class="rm-level-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รหัส...เช่น A,B,C,1,2,3,4', 'maxlength' => 1]],
            'rm_levelgroup_id' => [
              //'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter แผนก-ฝ่าย...', 'maxlength' => 50]
              'type'=>Form::INPUT_WIDGET,
              'widgetClass'=>'\kartik\widgets\Select2',
              'options'=>['data'=>ArrayHelper::map(RmLevelgroup::find()->all(), 'id','name'),
              'options' => ['placeholder' => 'Enter...ระดับความเสี่ยง'],],
              ],
            //'rm_levelgroup_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ระดับความเสี่ยง...', 'maxlength' => 1]],

            'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ชื่อ(บรรยายเกี่ยวกับความรุ่นแรง)...', 'maxlength' => 255]],

            //'discription' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รายละเอียด...', 'maxlength' => 255]],

            'class' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Class...', 'maxlength' => 255]],

            'color' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter สี...', 'maxlength' => 10]],

        ]

    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'บันทึก') : Yii::t('app', 'แก้ไข'),
        ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary glyphicon glyphicon-ok']
    );
    ActiveForm::end(); ?>

</div>
