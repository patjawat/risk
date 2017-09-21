<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
$this->title = 'ระดับความรุนแรง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-levelgroup-index">
  <span class="pul-left">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
  </span>
  <span class="pull-right">
  <style media="screen">
  .action-column {
    width: 20%;
  }
  </style>
  <?= Html::button('เพิ่มข้อมูล',
  ['value' => Url::to(['create']),
  'type'=>'button', 'title'=>$this->title,
  'class'=>'showModalButton btn btn-success glyphicon glyphicon-plus '
  ]) ;

  ?>&nbsp
  <?=Html::a(Yii::t('yii', 'ลบทั้งหมด'), '#', [
  'class' => 'btn btn-danger glyphicon glyphicon-trash',
  'title' => Yii::t('yii', 'Delete'),
  'aria-label' => Yii::t('yii', 'Delete'),
  'onclick' => "
  if (confirm('ok?')) {
    var keys = $('#grid').yiiGridView('getSelectedRows');
    if(keys.length>0){
      $.post('index.php?r=rm/department/delete-all',{ids:keys},function(data){
        $.pjax.reload({container: '#pjax-container'});
        $('#modal-dialog').modal('show').find('#modalContent').html(data);
      });
    }
  }
  ",
  ]) ?>
  </span>
  <br><br><br>
  <?php pjax::begin(['id' => 'pjax-container']); ?>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'id' => 'grid',
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    'columns' =>  [
      ['class' => '\kartik\grid\CheckboxColumn'],
      //['class' => 'yii\grid\SerialColumn'],
      [
        'attribute' => 'รหัส',
        'filterType' => GridView::FILTER_SELECT2,
        //'filter' => ArrayHelper::map(RmWorkgroup::find()->asArray()->all(), 'id', 'name'),
        'value' => function($model) {
          return $model->id;
        },
        //'header' => 'ประเภท',
        // 'vAlign' => 'middle',
        'width' => '5%',
      ],
      [
        'attribute' => 'name',
        'value' => function($model) {
          return $model->name;
        },
        //'header' => 'ประเภท',
        // 'vAlign' => 'middle',
        'width' => '70%',
      ],
      [
        'attribute' => 'color',
        'value' => function($model) {
          return $model->color;
        },
        //'header' => 'ประเภท',
        // 'vAlign' => 'middle',
        'width' => '10%',
      ],
      // ['class' => 'yii\grid\ActionColumn'],
      ['class' => 'yii\grid\ActionColumn', 'buttons' => [
        'view' => function ($url, $model, $key) {
          return Html::button('',
          ['value' => $url,
          'title' => $this->title,
          'class' => 'showModalButton btn btn-sm btn-primary glyphicon glyphicon-play'
        ]);
      },
      'update' => function ($url, $model, $key) {
        return Html::button('',
        ['value' => $url,
        'title' => $this->title,
        'class' => 'showModalButton btn btn-sm btn-info glyphicon glyphicon-edit'
      ]);
    },
    'delete' => function ($url) {
      return Html::a(Yii::t('yii', ''), '#', [
        'class' => 'btn btn-sm btn-warning glyphicon glyphicon-trash',
        'title' => Yii::t('yii', 'Delete'),
        'aria-label' => Yii::t('yii', 'Delete'),
        'onclick' => "
        if (confirm('ลบข้อมูล?')) {
          $.ajax('$url', {
            type: 'POST'
          }).done(function(data) {
            $.pjax.reload({container: '#pjax-container'});
          });
        }
        return false;
        ",
      ]);
    },

  ]
  ],
  ],

  ]); ?>
  <?php pjax::end(); ?></div>

  <?php
  $js = <<< JS
  $('#btn-delete').click(function(){

  });

JS;
$this->registerJs($js);
  ?>
