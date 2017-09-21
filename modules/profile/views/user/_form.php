<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use yii\widgets\MaskedInput;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use risk\modules\profile\models\Department;
use risk\modules\profile\models\Branch;
use risk\modules\profile\models\Type;
use risk\modules\profile\models\AuthItem;
use kartik\select2\Select2;
use risk\modules\profile\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
?>
<style media="screen">
.form-control {
  border-radius: 0;
  width: 100%;
  background-color: #f5f5f5;
  border-radius: 5px;
  font-weight: 500;
  font-family: 'Kanit', sans-serif;
  font-size: initial;
}
.form-control:focus{
  /*background-color:rgba(26, 187, 156, 0.48);*/
}
label {
  font-family: 'Kanit', sans-serif;
  font-size: initial;
}

</style>

<?php \yiister\adminlte\widgets\Box::begin([
                "header" => "ระบบจัดการผู้ใช้งาน",
                "icon" => "user",
                "collapsable" => true,
                "type" => \yiister\adminlte\widgets\Box::TYPE_WARNING,
            ]) ?>



<div class="user-form">
  <?php $form = ActiveForm::begin([
    'id' => 'user-form',
    'options' => ['data-pjax' => true ]
  ]); ?>

      <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
          <?= $form->field($employee, 'gender')->dropdownList(['empty'=>'-- เพศ --','M' => 'ชาย','W' => 'หญิง'],['id' =>'gender']) ?>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
          <?= $form->field($employee, 'name')->textInput(['maxlength' => true,'placeholder' => 'ระบุชื่อ-สกุล',]) ?>
        </div>

      </div>


      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <?=$form->field($employee, 'birthday')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
          ]);
          ?>
        </div>
        <div class="col-xs-6 col-sm-12 col-md-12 col-lg-6">
          <?php
          echo $form->field($employee, 'department_id')->widget(Select2::classname(), [
              'data' => $data,
              'language' => 'th',
              'options' => ['placeholder' => '-- Select --'],
              'data' => ArrayHelper::map(Department::find()->all(),'department_id','name'),
              'pluginOptions' => [
                  'allowClear' => true
              ],
          ]);
           ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <?= $form->field($employee, 'cid')->widget(MaskedInput::className(),[
            'mask'=>'9-9999-99999-99-9'
          ]); ?>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <?php
          echo $form->field($employee, 'branch_id')->widget(Select2::classname(), [
              'data' => $data,
              'language' => 'th',
              'options' => ['placeholder' => '-- Select --'],
              'data' => ArrayHelper::map(Branch::find()->all(),'branch_id','branch_name'),
              'pluginOptions' => [
                  'allowClear' => true
              ],
          ]);
           ?>
          <?php
          //  $form->field($employee, 'branch_id')->widget(AutoComplete::className(), [
          //                 'options' => [
          //                     'class' => 'form-control'
          //                 ],
          //                 'clientOptions' => [
          //                     'appendTo'=>'#form-id',
          //                     'source' => Branch::find()
          //                         ->select(['branch_id as id', 'branch_name as value', 'branch_name as label'])
          //                         ->groupBy('branch_name')
          //                         ->orderBy(['branch_name' => SORT_ASC])
          //                         ->asArray()->all(),
          //                     'select' => new JsExpression("function( event, ui ) {
          //                 $(this).val(ui.item.label);
          //             }")
          //                 ],
          //             ]);?>
        </div>

      </div>



      <?= $form->field($model, 'username')->textInput(['maxlength' => true,'style' => 'background-color:rgba(224, 114, 74, 0.19);']) ?>
      <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'style' => 'background-color:rgba(224, 114, 74, 0.19);']) ?>
      <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


  <div class="form-group">
    <?php echo Html::submitButton($model->isNewRecord ? '<span class="fa fa-check-square-o"> บันทึก' : '<span class="fa fa-check-square-o"> แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
  </div>

   <?php \yiister\adminlte\widgets\Box::end() ?>
  <?php $this->registerCss("
  div.required label.control-label:after {
      content: \" *\";
      color: red;
  }
  ")?>
<?php
$js = <<< JS
$(document).ready(function(){
    $('#gender').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
    $('#status_id').iCheck({
      checkboxClass: 'icheckbox_flat-red',
      radioClass: 'icheckbox_flat-red'
    });
  });
JS;
$this->registerJS($js);
?>
