<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Json;
use kartik\grid\GridView;
use kartik\widgets\DepDrop;
use kartik\dialog\Dialog;
use kartik\widgets\FileInput;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use yii\widgets\MaskedInput;
use kartik\time\TimePicker;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;
use risk\models\Department;
use risk\models\RmDepartmentPosition;
use risk\models\RmType;
use risk\models\RmGroup;
use risk\models\Rmitems;
use risk\models\RmLevel;
use risk\models\RmLevelgroup;
use risk\models\RmWorkgroup;
use risk\models\RmReporttype;
use risk\models\RmEffect;
use risk\models\Urgent;
use risk\models\Accident;
use risk\models\Editing;
use common\models\User;
use yii\widgets\Pjax;
//*list model
$type  = ArrayHelper::map(RmType::find()->all(),'id', 'name');
$group = ArrayHelper::map(RmGroup::find()->all(),'id', 'name');
$department = ArrayHelper::map(Department::find()->all(), 'department_id','name');
$RmDepartmentPosition = ArrayHelper::map(RmDepartmentPosition::find()->all(), 'id','name');
?>
<style media="screen">

.modal-dialog{
  width:30%;
}
#modal-dialog{
  width:30%;
  margin: auto;
  margin-top: 8%;
}
.rm-event-form{
  width: 95%;
  margin: auto;
}
.nav-tabs {
  /*background-color:#59ABE3;*/
}

.form-group {
  margin-bottom: 5px;
}
.help-block {
  display: block;
  margin-top: 2px;
  margin-bottom: 2px;
  color: #737373;
}
.col-md-6 {
  position: relative;
  min-height: 1px;
  padding-right: 1px;
  padding-left: 1px;
}
.col-md-offset-3 {
  /*margin-left: 1%;*/
}
legend {
  color: #37BC9B;
  font-family: thaisanslite;
  font-size: 25px;
  padding-left: 10px;
}
.title {
  color: #37BC9B;
  font-family: thaisanslite;
  font-size: 25px;
  padding-left: 10px;
}
label.control-label.col-md-4{
  /*width: 20px;*/
}
.med-box{
  background-color:rgba(79, 193, 233, 0.38);
  height: 50px;
  -webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
}
</style>
<?php  DetailView::widget([
    'model' => $model,
    'attributes' => [
      //'userreport.username',
      [
         'label' => 'วันที่เกิดเหตุ',
         'format' =>'html',
         'value' => '<span class="glyphicon glyphicon-calendar"></span>'.Yii::$app->thaiFormatter->asDateTime($model->event_date, 'php:d/m/Y H:i:s'),
     ],
     [
        'label' => 'รายงานวันที่',
        'format' =>'html',
        'value' => '<span class="glyphicon glyphicon-calendar"></span>'.Yii::$app->thaiFormatter->asDateTime($model->report_date, 'php:d/m/Y'),
    ],
      'rmItems.rmType.name',
     [
        'label' => 'กลุ่มความเสี่ยง',
        'value' => $model->rmItems->rmGroup->name,
    ],
     [
        'label' => 'ชื่อความเสี่ยง',
        'value' => $model->rmItems->name,
    ],
    [
       'label' => 'บรรยายเหตุการณ์',
       'format' => 'html',
       'value' => $model->rm_event_note,
   ],
        'rm_level_id',
        'rmLevel.rmLevelgroup.name',
        'rmDepartmentPosition.department.name',
        'rmDepartmentPosition.name',
        'accident.name',

        //'accident_name',
    ],
]) ?>
<?php $form = ActiveForm::begin([
  'id' => 'dynamic-form',
  'options' => ['enctype' => 'multipart/form-data'],
  'fieldConfig' => [
    'horizontalCssClasses' => [
      'label' => 'col-md-4',
      'offset' => 'col-md-offset-3',
      'wrapper' => 'col-md-7'
    ]
  ],
  'layout' => 'horizontal'
]); ?>
<?php echo $form->field($model, 'editing_id')->inline()->radioList(ArrayHelper::map(Editing::find()->all(),'id', 'name'), ['prompt' => '','id'=>'editing']) ?>
<?= $form->field($model, 'review', [
  'horizontalCssClasses' => [
    'offset' => 'col-md-offset-0',
    'wrapper' => 'col-lg-12',
  ],
  ])->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
      'imageManagerJson' => ['/redactor/upload/image-json'],
      'imageUpload' => ['/redactor/upload/image'],
      'fileUpload' => ['/redactor/upload/file'],
      'lang' => 'th',
      'plugins' => ['clips', 'fontcolor','imagemanager']
    ]
    ])->label(false)?>
          <?php ActiveForm::end(); ?>
