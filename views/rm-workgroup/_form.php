<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var risk\models\RmWorkgroup $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="rm-workgroup-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รหัสทีม...', 'maxlength' => 5]],

            'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ชื่อทีมคล่อม...', 'maxlength' => 255]],

        ]

    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'บันทึก') : Yii::t('app', 'แก้ไข'),
        ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary glyphicon glyphicon-ok']
    );
    ActiveForm::end(); ?>

</div>
