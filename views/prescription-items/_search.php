<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\PrescriptionItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prescription-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'prescription_error_id') ?>

    <?= $form->field($model, 'drug_items_id') ?>

    <?= $form->field($model, 'details') ?>

    <?= $form->field($model, 'lasa') ?>

    <?= $form->field($model, 'rm_event_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
