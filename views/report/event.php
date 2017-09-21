<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use risk\models\RmGroup;
use risk\models\RmType;
use risk\models\RmItems;
use risk\models\RmEvent;
?>
<?php yii\widgets\Pjax::begin(['id' => 'grid-pjax']) ?>
<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
<br>
<?php
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'showPageSummary'=>true,
    'pjax'=>true,
    'striped'=>true,
    'hover'=>true,

    'panel'=>['type'=>'primary', 'heading'=>'Grid Grouping Example'],
    'columns'=>[
        ['class'=>'kartik\grid\SerialColumn'],
        [
            'attribute'=>'rm_group_id',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) {
               return $model->rmItems->rmGroup->name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(RmGroup::find()->all(), 'id', 'name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any supplier'],
            'group'=>true,  // enable grouping,
            'groupedRow'=>true,                    // move grouped column to a single grouped row
            'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
        ],
        [
           'attribute'=>'rm_items_id',
           'width'=>'250px',
           'value'=>function ($model, $key, $index, $widget) {
               return $model->rmItems->name;
           },
           'filterType'=>GridView::FILTER_SELECT2,
           'filter'=>ArrayHelper::map(RmItems::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
           'filterWidgetOptions'=>[
               'pluginOptions'=>['allowClear'=>true],
           ],
           'filterInputOptions'=>['placeholder'=>'Any category'],
           'group'=>true,  // enable grouping
           'subGroupOf'=>1 // supplier column index is the parent group
       ],
       [
        //  'attribute'=>'rm_items_id',
        'label' => 'รวม',
          'width'=>'250px',
          'value'=>function ($model, $key, $index, $widget) {
              //return $model->rmItems->name;
              return RmEvent::find()->big($model->rm_items_id)->count();
          },


      ],
      //  [
      //      'attribute'=>'id',
      //      'pageSummary'=>'Page Summary',
      //      'pageSummaryOptions'=>['class'=>'text-right text-warning'],
      //  ],
        // [
        //     'attribute'=>'rm_items_id',
        //     'width'=>'250px',
        //     'value'=>function ($model, $key, $index, $widget) {
        //         // return $model->rmItems->name;
        //         return $model->rmItems->name;
        //     },
        //     'filterType'=>GridView::FILTER_SELECT2,
        //     'filter'=>ArrayHelper::map(RmGroup::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        //     'filterWidgetOptions'=>[
        //         'pluginOptions'=>['allowClear'=>true],
        //     ],
        //     'filterInputOptions'=>['placeholder'=>'Any category'],
        //     'group'=>true,  // enable grouping
        //     'subGroupOf'=>1 // supplier column index is the parent group
        // ],
          // [
          //   //  'attribute'=>'rm_items_id',
          //     'width'=>'250px',
          //     'value'=>function ($model, $key, $index, $widget) {
          //         return RmEvent::find()->big($model->rm_items_id)->count();
          //     },
          //   ],
            // [
            //   //  'attribute'=>'rm_items_id',
            //     'width'=>'250px',
            //     'value'=>function ($model, $key, $index, $widget) {
            //         return RmEvent::find()->big1($model->rm_level_id)->count();
            //     },
            //   ],
        // [
        //     'attribute'=>'name',
        //     'pageSummary'=>'Page Summary',
        //     'pageSummaryOptions'=>['class'=>'text-right text-warning'],
        // ],
        // [
        //     'attribute'=>'unit_price',
        //     'width'=>'150px',
        //     'hAlign'=>'right',
        //     'format'=>['decimal', 2],
        //     'pageSummary'=>true,
        //     'pageSummaryFunc'=>GridView::F_AVG
        // ],
        // [
        //     'attribute'=>'units_in_stock',
        //     'width'=>'150px',
        //     'hAlign'=>'right',
        //     'format'=>['decimal', 0],
        //     'pageSummary'=>true
        // ],
        // [
        //     'class'=>'kartik\grid\FormulaColumn',
        //     'header'=>'Amount In Stock',
        //     'value'=>function ($model, $key, $index, $widget) {
        //         $p = compact('model', 'key', 'index');
        //         return $widget->col(4, $p) * $widget->col(5, $p);
        //     },
        //     'mergeHeader'=>true,
        //     'width'=>'150px',
        //     'hAlign'=>'right',
        //     'format'=>['decimal', 2],
        //     'pageSummary'=>true
        // ],

    ],
]);

 ?>
 <?php yii\widgets\Pjax::end() ?>
