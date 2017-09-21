<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use yii\web\JsExpression;
?>
<?php \yiister\adminlte\widgets\Box::begin(
            [
                "header" => "#เนื้อหาเกี่ยวกับระบบ",
                "type" => \yiister\adminlte\widgets\Box::TYPE_SUCCESS,
                "removable" => true,
            ])
        ?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
         'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
     ]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก' : '<i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
 <?php \yiister\adminlte\widgets\Box::end() ?>
