<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use risk\models\RmEvent;
use cenotia\components\modal\RemoteModal;
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
?>
<?php RemoteModal::begin([
	"id"=>"modal",
	"options"=> [ "class"=>"fade stick-up"],
	"footer"=>"", // always need it for jquery plugin
	])?>
<?php RemoteModal::end(); ?>
<?php Pjax::begin(); ?>
<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'headerRowOptions' => function(){
    return ['style'=>'background-color:#eee;'];
  },
  'rowOptions' => function ($model, $index, $widget, $grid){
  },

  'columns' => [
    ['class' => 'yii\grid\SerialColumn'],
    [
      'attribute'=>'event_date',
      'vAlign'=>'middle',
      'width'=>'10%',
      'value'=>function ($model, $key, $index, $widget) {
        return Yii::$app->thaiFormatter->asDate($model->event_date, 'php:d/m/Y');
      },
    ],
    [
      'attribute' => 'rm_items_id',
      'width' => '55%',
      'value' => function($model){
        return $model->rmItems->name;
      }
    ],
    [
      'attribute'=>'rm_group_id',
      'vAlign'=>'middle',
      'width'=>'180px',
      'value'=>function ($model, $key, $index, $widget) {
        return $model->rm_workgroup_id;
      },
      'filterType'=>GridView::FILTER_SELECT2,
      'filter'=>ArrayHelper::map(RmGroup ::find()->where(['NOT IN', 'id', ['00']])->all(), 'id', 'id'),
      'filterWidgetOptions'=>[
        'pluginOptions'=>['allowClear'=>true],
      ],
      'filterInputOptions'=>['placeholder'=>'--Select--'],
      'format'=>'raw'
    ],

    [
      'class' => 'yii\grid\ActionColumn',
      'buttonOptions'=>['class'=>'btn btn-default'],
      'header' => 'Action',
      'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {review}{view} {update} {delete} </div>',
      'options'=> ['style'=>'width:190px;'],
      'buttons'=>[
        'review' => function($url,$model,$key){
          if ($model->editing_id ==2) {

            return Html::a('<i style="color:red"  class="glyphicon glyphicon-repeat"></i>',$url,['class'=>'btn btn-default','role' => 'modal']);
          }else {
            return Html::a('<i style="color:green" class="glyphicon glyphicon-ok"></i>',$url,['class'=>'btn btn-default','role' => 'modal']);
          }
        }
      ]
    ],
  ],
]); ?>
<?php Pjax::end(); ?>
