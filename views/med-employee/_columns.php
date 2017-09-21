<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use risk\models\MedPosition;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
      'class'=>'\kartik\grid\DataColumn',
      'attribute'=>'med_position_id',
      'vAlign'=>'middle',
      'width'=>'350px',
      'value'=>function ($model, $key, $index, $widget) {
        return $model->medPosition->name;
      },
      'filterType'=>GridView::FILTER_SELECT2,
      'filter'=>ArrayHelper::map(MedPosition::find()->all(), 'id', 'name'),
      'filterWidgetOptions'=>[
        'pluginOptions'=>['allowClear'=>true],
      ],
      'filterInputOptions'=>['placeholder'=>'--Select--'],
      'format'=>'raw'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id' => $model->id,'med_position_id' => $model->med_position_id]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
    ],

];
