<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use dosamigos\switchinput\SwitchBox;
use risk\models\Department;
use risk\models\RmWorkgroup;
/* @var $this yii\web\View */
/* @var $searchModel risk\models\RmEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'งานประจำวัน';
$this->params['breadcrumbs'][] = $this->title;
?>

<style media="screen">
.btn-sm, .btn-group-sm > .btn {
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
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
</style>
<div class="row" style="background-color:#FFFFFF;padding-top:10px;padding-bottom: 5px;">
       <div class="col-md-4">


<!-- <h1 class="animated infinite bounce">Example</h1> -->
<?php
$session = Yii::$app->session;

// the following code will NOT work
//$session['captcha']['number'] = 5;
// $session['captcha']['lifetime'] = 3600;

// the following code works:
$session['captcha'] = [
    'number' => 5,
    'lifetime' => 3600,
];

// the following code also works:
echo $session['captcha']['lifetime'];


 ?>

  <h1 id="yourElement">งานประจำวัน
    <?php
   echo Html::img('@web/icon-svg/self_service_kiosk.svg',[
    'class' => 'tile-image big-illustration',
    'width' => 100,
    'data-container'=>"body",
     'data-toggle' =>"popover",
      "data-placement"=>"top",
    "data-content"=>"รายงานอุบัติการจำนวน 5 ใบที่ คลิกเพื่อทำหารตรวจรับเอกสาร"
  ]);?></h1>

<?php echo Html::a('เพิ่มอุบัติการความเสี่ยง', ['/rm/rm-event/create'], ['class' => 'btn btn-success glyphicon glyphicon-plus ']) ?>
&nbsp;
  <?php  Html::button('ตรวจรับรายงานความเสี่ยง',
  ['value' => Url::to(['create']),
  'type'=>'button', 'title'=>$this->title,
  'class'=>'showModalButton btn btn-success glyphicon glyphicon-envelope '
  ]) ;?>
</div>
<?php $form = ActiveForm::begin([
  'id' => 'form',
'fieldConfig' => [
    'horizontalCssClasses' => [
        'label' => 'col-md-5',
        'offset' => 'col-md-offset-3',
        'wrapper' => 'col-md-7'
    ]
],
'layout' => 'horizontal'
]); ?>





<div class="col-md-4">
       <?php
           // Normal select with ActiveForm & model
       echo $form->field($model, 'department_id')->widget(Select2::classname(), [
         'data' => ArrayHelper::map(Department::find()->all(), 'id','name'),
         'language' => 'th',
         'options' => ['placeholder' => 'Select...','id' => 'department_id'],
         'pluginOptions' => [
         'allowClear' => true
         ],
         ]);
         ?>

       <?php
           // Normal select with ActiveForm & model
       echo $form->field($model, 'rm_workgroup_id')->widget(Select2::classname(), [
         'data' => ArrayHelper::map(RmWorkgroup::find()->all(), 'id','name'),
         'language' => 'th',
         'options' => ['placeholder' => 'Select...','id' => 'rm_workgroup_id'],
         'pluginOptions' => [
         'allowClear' => true
         ],
         ]);
         ?>


     </div>
     <div class="col-md-4">
       <?php
           // Normal select with ActiveForm & model
       echo $form->field($model, 'rm_level_id')->widget(Select2::classname(), [
         'data' => ArrayHelper::map(Department::find()->all(), 'id','name'),
         'language' => 'th',
         'options' => ['placeholder' => 'Select...','id' => 'rm_level_id'],
         'pluginOptions' => [
         'allowClear' => true
         ],
         ]);
         ?>

       <?php
           // Normal select with ActiveForm & model
       echo $form->field($model, 'rm_levelgroup_id')->widget(Select2::classname(), [
         'data' => ArrayHelper::map(RmWorkgroup::find()->all(), 'id','name'),
         'language' => 'th',
         'options' => ['placeholder' => 'Select...','id' => 'rm_levelgroup_id'],
         'pluginOptions' => [
         'allowClear' => true
         ],
         ]);
         ?>
        </div>
 </div>
     <?php ActiveForm::end(); ?>

  <?php pjax::begin(['id' => 'pjax-container']); ?>
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
              'attribute' => 'rm_items_id',
              'header' => 'ชื่อความเสี่ยง',
              'width' => '30%',
              'contentOptions' => ['class' => 'text-center'],
              'value' => function($model){
                return $model->rmItems->name;
              }
            ],
            [
              'attribute' => 'rm_levelgroup_id',
              'header' => 'ความรุนแรง',
              'width' => '7%',
              'contentOptions' => ['class' => 'text-center'],
              'value' => function($model){
                return $model->rmLevel->rmLevelgroup->name;
              }
            ],
            [
              'attribute' => 'rm_level_id',
              'header' => 'ความเสี่ยง',
              'width' => '7%',
              'contentOptions' => ['class' => 'text-center'],
              'value' => function($model){
                return $model->rmLevel->id;
              }
            ],
            [
              'attribute' => 'event_date',
              'header' => 'เกิดเหตุวันที่',
              'format' =>'raw',
              'width' => '15%',
              'value' => function($model){
                return $model->datetimeFromdb($model->event_date);
              }
            ],
            [
              'attribute' => 'department_id',
              'header' => 'แผนก/ฝ่าย',
              'value' => function($model){
                return $model->rmDepartmentPosition->department->name;
              }
            ],
            [
              'attribute' => 'rm_group_id',
              'header' => 'ทีมคล่อม',
              'width' => '6%',
              'contentOptions' => ['class' => 'text-center'],
              'value' => function($model){
              return $model->rmItems->rmGroup->rmWorkgroup->id;
                // return $model->rmItems->rmGroup->rmWorkgroup->name;
              }
            ],
            [
              'attribute' => 'check_date',
              'header' => 'สถานะ',
              'format' =>'raw',
              'value' => function($model){
                if($model->check_date == NULL){
                  return Html::button('ตรวจรับ', [
                    'value' => yii\helpers\Url::to(['/rm/rm-event/view-check',
                    'id' => $model->id
                  ]),
                    'title' => 'บันทึกอุบัติการความเสี่ยงเลขที่'.$model->id,
                    'class' => 'showModalButton btn btn-sm btn-warning glyphicon glyphicon-edit']);

                }elseif ($model->review_date == NULL && $model->check_date !== NULL) {

                }
              }
            ],

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<!-- Loader -->

<?php
$js = <<< JS
 $(function(){
   $('#yourElement').addClass('animated fadeInUp');

 });
JS;
$this->registerJs($js);
?>

<br>
