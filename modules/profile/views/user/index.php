<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\bootstrap\Modal;
use cenotia\components\modal\RemoteModal;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use risk\modules\profile\models\Profile;

$this->title = 'การตั้งค่าผู้ใช้งานระบบ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">
  <?php RemoteModal::begin([
  	"id"=>"modal",
  	"options"=> [ "class"=>"fade slide-right "],
  	"footer"=>"", // always need it for jquery plugin
  	])?>
  <?php RemoteModal::end(); ?>
  <?php \yiister\adminlte\widgets\Box::begin([
                  "header" => "ระบบจัดการผู้ใช้งาน",
                  "icon" => "user",
                  "collapsable" => true,
                  "type" => \yiister\adminlte\widgets\Box::TYPE_WARNING,
              ]) ?>
    <?= Html::a('<span class="fa fa-user-circle-o"></span> เพิ่มผู้ใช้งาน', ['create'], ['class' => 'btn btn-success','role' => 'modal_']) ?>


      <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'#',
            'headerOptions'=>['class'=>'kartik-sheet-style']
          ],
          [
            'attribute'=>'username',
            'header'=>'ชื่อเข้าใช้งาน',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'width'=>'180px',
            'value'=>function ($model, $key, $index, $widget) {
              return $model->username;
            },
          ],
          [
            'attribute'=>'email',
            'header'=>'E-Mail',
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'width'=>'180px',
            'value'=>function ($model, $key, $index, $widget) {
              return $model->email;
            },
          ],
          [
            'attribute'=>'id',
            'header' => 'ชื่อ-สกุล',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'width'=>'300px',
            'value'=>function ($model, $key, $index, $widget) {
              return $model->profile->name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Profile ::find()->all(), 'user_id', 'name'),
            'filterWidgetOptions'=>[
              'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--Select--'],
            'format'=>'raw'
          ],
          [
            'attribute'=>'cid',
            'header' => 'เลขบัตรประชาชน',
            'mergeHeader'=>true,
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'width'=>'250px',
            'value'=>function ($model, $key, $index, $widget) {
                //return $model->employee->cid;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Profile ::find()->all(), 'user_id', 'name'),
            'filterWidgetOptions'=>[
              'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--Select--'],
            'format'=>'raw'
          ],

          [
            'attribute'=>'branch_id',
            'header' => 'หน่วยงาน',
            'mergeHeader'=>true,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'width'=>'300px',
            'value'=>function ($model, $key, $index, $widget) {
                //return $model->employee->branch->branch_name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Profile ::find()->all(), 'user_id', 'name'),
            'filterWidgetOptions'=>[
              'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--Select--'],
            'format'=>'raw'
          ],
          [
            'attribute'=>'department_id',
            'header' => 'แผนก/ฝ่าย',
            'mergeHeader'=>true,
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'width'=>'300px',
            'value'=>function ($model, $key, $index, $widget) {

            return $model->employee->department->name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Profile ::find()->all(), 'user_id', 'name'),
            'filterWidgetOptions'=>[
              'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'--Select--'],
            'format'=>'raw'
          ],
          [
            'class' => 'kartik\grid\ActionColumn',

            //'buttonOptions'=>['class'=>'btn btn-default'],
            'header' => 'Action',
            'mergeHeader'=>true,
            'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {review}  {view} {update} {delete} </div>',
            'options'=> ['style'=>'width:100px;'],
            'buttons'=>[
              'review' => function($url,$model,$key){
                return Html::a('',['/admin/assignment/view','id'=>$model->id],['class'=>'glyphicon glyphicon-user','role' => 'modal']);
              }
            ]
          ],

        ],
      ]); ?>
      <?php Pjax::end(); ?>
 <?php \yiister\adminlte\widgets\Box::end() ?>
