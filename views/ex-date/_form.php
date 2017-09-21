<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model risk\models\ExDate */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

$this->registerJs(
   '$("document").ready(function(){
        $("#new_country").on("pjax:end", function() {
            $.pjax.reload({container:"#countries"});  //Reload GridView
        });
    });'
);
?>
<div class="ex-date-form">
<?php yii\widgets\Pjax::begin(['id' => 'new_country']) ?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

    <?= $form->field($model, 'start')->textInput(); ?>
<?= $form->field($model, 'end')->textInput(); ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>

</div>
<h3><?= $stringHash ?></h3>
