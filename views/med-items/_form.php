<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use risk\models\MedType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model risk\models\MedItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="med-items-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        // Normal select with ActiveForm & model
    echo $form->field($model, 'med_type_id', [
    ])->widget(Select2::classname(), [
      'data' => ArrayHelper::map(MedType::find()->all(), 'id','name'),
      'language' => 'th',
      'options' => ['placeholder' => '-- เลือก --'],
      'pluginOptions' => [
      'allowClear' => true
      ],
      ]);
      ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
