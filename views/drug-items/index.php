<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use cenotia\components\modal\RemoteModal;
/* @var $this yii\web\View */
/* @var $searchModel risk\models\DrugItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการยา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-items-index">
  <?php
  RemoteModal::begin([
      "id"=>"modal",
      "options"=> [ "class"=>"fade stick-up"],
      "footer"=>"", // always need it for jquery plugin
    ]);
    RemoteModal::end(); ?>
                  <div class="ibox float-e-margins ui-sortable">
                              <div class="ibox-title"><h5><span class="glyphicon glyphicon-tasks"></span>ตั้งค่า<?=$this->title;?></div>
                              <div class="ibox-content">
      <?= Html::a('เพิ่ม', ['/drug-items/create'],['class' => 'btn btn-success glyphicon glyphicon-plus','role' => 'modal' ]);?>

<?php pjax::begin(['id' => 'pjax-container']); ?>
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'icode',
            'name',
            'generic_name',
            [
              'class' => 'yii\grid\ActionColumn',
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'<div class="btn-group btn-group-sm text-center" >{copy} {view} {update} {delete} </div>',
              'options'=> ['style'=>'width:150px;'],
              'buttons'=>[
                  'view' => function($url,$model,$key){
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',$url,['class' => 'btn btn-default','role' => 'modal' ]);
                    },
                    'update' => function($url,$model,$key){
                      return Html::a('<i class="glyphicon glyphicon-edit"></i>',$url,['class' => 'btn btn-default','role' => 'modal' ]);
                      },
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>
</div>
