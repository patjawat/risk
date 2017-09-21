<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\MedError */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="med-error-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rm_event_id')->textInput() ?>

    <?= $form->field($model, 'med_items_id')->textInput() ?>

    <?= $form->field($model, 'med_type_id')->textInput() ?>

    <?= $form->field($model, 'med_employee_id')->textInput() ?>

    <?= $form->field($model, 'lasa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
