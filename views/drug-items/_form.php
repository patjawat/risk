<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\DrugItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drug-items-form">

    <?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'icode')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'generic_name')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

</div>
