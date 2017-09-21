<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use johnitvn\ajaxcrud\BulkButtonWidget;
use risk\modules\content\models\BlogCategory;
$this->title = 'จัดการเนื้อหาบทความ';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
\yiister\adminlte\widgets\Box::begin(
   [
       "header" => "เนื้อหา/บทความ",
       "icon" => "edit",
       "type" => \yiister\adminlte\widgets\Box::TYPE_WARNING,
   ]
)
?>

<p>
  <?= Html::a('<i class ="glyphicon glyphicon-folder-open"></i>  สร้างบทความ', ['/content/blog'], ['class' => 'btn btn-primary']) ?>
  <?= Html::a('<i class ="glyphicon glyphicon-folder-open"></i>  หมวดหมู่ของเนื้อหา', ['/content/blog-category'], ['class' => 'btn btn-success']) ?>

    <?php //Html::button('<i class="glyphicon glyphicon-trash"></i> ลบทั้งหมด', ['class' => 'btn btn-danger','id'=>'btn-delete'])?>
</p>
<?php Pjax::begin(['id' => 'grid-container']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'floatHeader' => false,
    'headerRowOptions' => ['class' =>''],
    'showPageSummary' => true,
    'persistResize'=>true,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => false,
    'pjax'=>true,
    'toolbar'=> [
        ['content'=>
        Html::a('<i class="glyphicon glyphicon-plus"></i> สร้างใหม่', ['create'], ['class' => 'btn btn-success'])
            //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'22', 'class'=>'btn btn-success pull-left', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
        ],
        Html::a('<i class="glyphicon glyphicon-repeat"></i> คืนค่า', [''],
        ['data-pjax'=>1, 'class'=>'btn btn-warning', 'title'=>'Reset Grid']),
        Html::button('<i class="glyphicon glyphicon-trash"></i> ลบทั้งหมด', ['class' => 'btn btn-danger','id'=>'btn-delete']),
        '{export}',
        '{toggleData}',
    ],
    'panel' => [
        'type' => 'primary',
        'heading' => '<i class="glyphicon glyphicon-list"></i> แสดงการเสร้างเนื้อหา/บทความ',
        'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
        'after'=>BulkButtonWidget::widget([
                    'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                        ["bulk-delete"] ,
                        [
                            "class"=>"btn btn-danger btn-xs",
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'Are you sure?',
                            'data-confirm-message'=>'Are you sure want to delete this item'
                        ]),
                ]).
                '<div class="clearfix"></div>',
    ],
    'export'=>[
        'fontAwesome'=>true
    ],
    'toggleDataOptions'=>['minCount'=>10],

        'columns' => [
          [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'#',
            'headerOptions'=>['class'=>'kartik-sheet-style']
          ],
          [
            'class' => '\kartik\grid\DataColumn',
            'filterType'=>GridView::FILTER_DATE,
            'filterWidgetOptions'=>[
              'pluginOptions'=>[
                'allowClear'=>true,
                'autoclose' => true,

              ],
              'language' => 'th'
            ],
            'attribute' => 'create_at',
            'format' => 'raw',
            'vAlign'=>'middle',
            'hAlign'=>'left',
            'width'=>'100px',
            'value'=>function($model){
              return '<code><i class="fa fa-calendar-minus-o" aria-hidden="true"></i></code>'.Yii::$app->formatter->asDate($model->create_at, 'php:d/m/Y').'';
            }
          ],
            [
              'attribute' => 'name',
              'vAlign'=>'middle',
              'hAlign'=>'left',
              'width'=>'200px',
              'value'=>function ($model, $key, $index, $widget) {
              return   $model->name;
              }
            ],
            [
              'attribute' => 'blog_category_id',
              'vAlign'=>'middle',
              'hAlign'=>'left',
              'width'=>'200px',
              'filterType'=>GridView::FILTER_SELECT2,
              'filter'=>ArrayHelper::map(Blogcategory ::find()->all(), 'id', 'name'),
              'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
              ],
              'filterInputOptions'=>[
                'id' => 'branch_id',
                'placeholder'=>'--Select--'
              ],
              'value'=>function ($model, $key, $index, $widget) {
                return $model->blogCategory->name;
              }
            ],

            [
              'class' => 'kartik\grid\ActionColumn',
              'header' => 'ดำเนินการ',
              'template'=>'{view} {update} {delete} ',
              'options'=> ['style'=>'width:8%;'],
            ],
            [
                'class'=>'kartik\grid\CheckboxColumn',
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php \yiister\adminlte\widgets\Box::end() ?>
</div>
<?php
$this->registerJs('
  jQuery("#btn-delete").click(function(){
    var keys = $("#w0").yiiGridView("getSelectedRows");
    //console.log(keys);
    if(keys.length>0){
      jQuery.post("'.Url::to(['delete-all']).'",{ids:keys.join()},function(){
      });
    }
  });
');
 ?>
