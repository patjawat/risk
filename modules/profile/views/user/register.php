<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
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
  @import url('https://fonts.googleapis.com/css?family=Kanit:200,400|PT+Sans|PT+Serif');
.modal-dialog {
  width: 60%;
  margin-top: 30px;
}
.form-group {
    margin-bottom: 0px;
}
.col-sm-6 {
    width: 70%;
}
.form-control {
    border-radius: 0;
    width: 100%;
    background-color: rgba(210, 214, 222, 0.43);
    border-radius: 4px;
    font-family: 'Kanit', sans-serif;
    font-size: initial;
    color: #777;
}
label {
    display: inline-block;
    max-width: 30%;
}
.form-horizontal .control-label {
  color: #777;
  font-family: 'Kanit', sans-serif;
  font-size: initial;
}

.select2-container--krajee .select2-selection {
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    background-color:rgba(210, 214, 222, 0.43);
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #555555;
    font-size: 14px;
    outline: 0;
}
.thumbnail {
    height: 299px;
    overflow: hidden;
}
.thumbnail .image {
    height: 260px;
    overflow: hidden;
}
.view .mask, .view .content {
    position: absolute;
    /*width: 100%;*/
    height: 280px;
    overflow: hidden;
    top: 0;
    left: 0;
}
.view .tools {
    margin: 180px 0 0 0;
}
.user-form{
  width: 50%;
  margin: auto;
}
.radio-inline, .checkbox-inline {

     padding-left:0px;

}
</style>

<div class="user-form">
  <h1><i class="fa fa-user-plus" aria-hidden="true"></i> ลงทะเบียนเข้าใช้งานระบบ</h1>
  <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'id' => 'user-form',
    'options' => ['data-pjax' => true ]
  ]); ?>
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-id-card"></i> ข้อมูลทั่วไป</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">


          <?= $form->field($employee, 'gender')->inline()->radioList([/*'empty'=>'-- เพศ --',*/'M' => 'ชาย','W' => 'หญิง'],['id' =>'gender']) ?>


          <?= $form->field($employee, 'name')->textInput(['maxlength' => true,'placeholder' => 'ระบุชื่อ-สกุล']) ?>


      </div>

          <?=$form->field($employee, 'birthday',['horizontalCssClasses' => ['wrapper' => 'col-sm-4','id'=>'birthday']])->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
          ]);
          ?>
          <?= $form->field($employee, 'cid',['horizontalCssClasses' => ['wrapper' => 'col-sm-3']])->widget(MaskedInput::className(),[
            'mask'=>'9-9999-99999-99-9',
          ]); ?>
          <?php
          echo $form->field($employee, 'department_id',['horizontalCssClasses' => ['wrapper' => 'col-sm-5']])->widget(Select2::classname(), [
              'data' => $data,
              'language' => 'th',
              'options' => ['placeholder' => '-- Select --'],
              'data' => ArrayHelper::map(Department::find()->all(),'department_id','name'),
              'pluginOptions' => [
                  'allowClear' => true
              ],
          ]);
           ?>



          <?php
          echo $form->field($employee, 'branch_id',['horizontalCssClasses' => ['wrapper' => 'col-sm-5']])->widget(Select2::classname(), [
              'data' => $data,
              'language' => 'th',
              'options' => ['placeholder' => '-- Select --'],
              'data' => ArrayHelper::map(Branch::find()->all(),'branch_id','branch_name'),
              'pluginOptions' => [
                  'allowClear' => true
              ],
          ]);
           ?>
    </div>
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-tasks"></i> ข้อมูลเข้าใช้ระบบ</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <?= $form->field($model, 'username')->textInput(['maxlength' => true,'style' => 'background-color:rgba(224, 114, 74, 0.19);']) ?>
      <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'style' => 'background-color:rgba(224, 114, 74, 0.19);']) ?>
      <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    </div>
  </div>
  <div class="form-group">
    <?php echo Html::submitButton($model->isNewRecord ? '<span class="fa fa-check-square-o"> บันทึก' : '<span class="fa fa-check-square-o"> แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
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

    // ตรวจสอบค่าว่าง ,'id'=>'birthday'
    $('form').submit(function(){
           if($('#employee-name').val()==""){
            alert('กอรก ชื่อ-นามสกุล');
            $('#name').focus();
            return false;
          }else if($('#employee-cid').val()==""){
              alert('กอรก ชื่อ-นามสกุล555');
              $('#employee-cid').focus();
              return false;
          }else{
            return true;
          }
          //alert($("#employee-cid").val());


     });
  });
JS;
$this->registerJS($js);
?>
