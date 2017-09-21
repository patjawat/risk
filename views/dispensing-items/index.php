<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<div class="box box-default">
<div class="box-header with-border">
<h3 class="box-title glyphicon glyphicon-menu-hamburger">รายชื่อความคลาดเคลื่อนในการจ่ายยา</h3>
<div class="box-tools pull-right">
<?= Html::a('เพิ่ม', ['/rm/dispensing-items/create','id' => $id],['class' => 'btn btn-info glyphicon glyphicon-plus','role' => 'modal']);?>
</div>
</div>
<div class="box-body">
<?php pjax::begin(['id' => 'dispensing-items']); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'id'=> 'grid-id',
        'columns' => [
          ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],
            'dispensingError.name',
            [
              'attribute' => 'Lasa',
              'format' => 'html',
               'contentOptions'=>['style'=>'width:10px;'],
              'value' => function($model){
                if($model->lasa ==""){
                  //return $model->lasa;
                  return "";
                }else {
                    return "<span class='ion-checkmark-round'></span>";
                }
              }
            ],
            'drugItems.generic_name',
            'details',
            [
          'class' => 'yii\grid\ActionColumn',
            // 'buttonOptions'=>['class'=>'','role'=>'modal'],
          'header' => 'Actions',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{update}{delete}',
          //
          'buttons' => [

            'update' => function ($url, $model) {
              $url ='index.php?r=rm/dispensing-items/update&dispensing_error_id='.$model->dispensing_error_id.'&drug_items_id='.$model->drug_items_id.'&id='.$model->id;
                return Html::a('<span class="btn btn-sm btn-warning glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),'role'=>'modal'
                ]);
            },
            'delete' => function ($url, $model) {
              $url ='index.php?r=rm/dispensing-items/delete&dispensing_error_id='.$model->dispensing_error_id.'&drug_items_id='.$model->drug_items_id.'&id='.$model->id;
                return Html::a('&nbsp<span class="btn btn-sm btn-danger glyphicon glyphicon-trash"></span>', '#', [
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'onclick' => "
                                if (confirm('ok?')) {
                                    $.ajax('$url', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#dispensing-items'});
                                    });
                                }
                                return false;
                            ",
                        ]);
            }
          ],

          ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
      <?php pjax::end(); ?>
  </div>
  </div>
