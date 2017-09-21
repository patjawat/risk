<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'หมวดหมู่เนื้อหา';
$this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
.action-column {
    width: 50px;
}
</style>
<div class="rm-article-category-index">
  <span class="pull-right">

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
        $.post('index.php?r=rm/rm-article-category/delete-all',{ids:keys},function(data){
          $.pjax.reload({container: '#pjax-container'});
          $('#modal-dialog').modal('show').find('#modalContent').html(data);
        });
      }
    }
    ",
  ]) ?>
  </span>
  <br>
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
    'columns' => [
      ['class' => '\kartik\grid\CheckboxColumn'],
      //['class' => 'kartik\grid\SerialColumn'],
      [
        'attribute' => 'รหัส',
        'value' => function($model) {
          return $model->id;
        },
        //'header' => 'ประเภท',
        // 'vAlign' => 'middle',
        'width' => '10px',
      ],
      [
        'attribute' => 'name',
        'value' => function($model) {
          return $model->name;
        },
        //'header' => 'ประเภท',
        // 'vAlign' => 'middle',
        'width' => '65%',
      ],
      ['class' => 'yii\grid\ActionColumn', 'buttons' => [
        'view' => function ($url, $model, $key) {
          return Html::button('',
          ['value' => $url,
          'title' => 'หมวดหมู่ : '.$model->name,
          'class' => 'showModalButton btn btn-sm btn-primary glyphicon glyphicon-play'
        ]);
      },
      'update' => function ($url, $model, $key) {
        return Html::button('',
        ['value' => $url,
        'title' => 'แก้ไขเนื้อหา : '.$model->name,
        'class' => 'showModalButton btn btn-sm btn-info glyphicon glyphicon-edit'
      ]);
    },
    'delete' => function ($url) {
      return Html::a(Yii::t('yii', ''), '#', [
        'class' => 'btn btn-sm btn-warning glyphicon glyphicon-trash',
        'title' => Yii::t('yii', 'Delete'),
        'aria-label' => Yii::t('yii', 'Delete'),
        'onclick' => "
        if (confirm('ok?')) {
          $.ajax('$url', {
            type: 'POST'
          }).done(function(data) {
            $.pjax.reload({container: '#pjax-container'});
            alert('ลบข้อมูลสำเร็จ');

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

<?php pjax::end(); ?>
