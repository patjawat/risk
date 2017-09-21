<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\MedErrorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="med-error-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rm_event_id') ?>

    <?= $form->field($model, 'med_items_id') ?>

    <?= $form->field($model, 'med_type_id') ?>

    <?= $form->field($model, 'med_employee_id') ?>

    <?php // echo $form->field($model, 'lasa') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
