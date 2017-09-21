<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\TranscribingItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transcribing-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'transcribing_error_id') ?>

    <?= $form->field($model, 'drug_items_id') ?>

    <?= $form->field($model, 'details') ?>

    <?= $form->field($model, 'rm_event_id') ?>

    <?= $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'lasa') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
