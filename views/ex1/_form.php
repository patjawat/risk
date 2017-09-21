<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
 use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model risk\models\Ex1 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ex1-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'date')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
         'ajaxConversion'=>true,
         'options' => ['placeholder' => 'Select issue date ...'],
        'language' => 'th',
        'widgetOptions' => [
            'pluginOptions' => [
              'placeholder' => 'Data de Pagamento',

                // 'autoclose' => true
            ]
        ]
    ]);
     ?>
     <?php
     echo $form->field($model, 'datetime')->widget(DateControl::classname(), [
     'type'=>DateControl::FORMAT_DATETIME
 ]);
      ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
