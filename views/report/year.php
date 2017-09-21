<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use kartik\growl\Growl;
use risk\models\RmItems;
use risk\models\RmDepartment;
use risk\models\RmWorkgroup;
 ?>

 <?php
 $gridColumns = [
   ['class' => 'kartik\grid\SerialColumn'],
   [
       'attribute' => 'name',
       'value' => function($model) {return $model['year'];},
       'header' => 'ปี',
        'width' => '10px',
    ],
    [
       'attribute' => 'total',
       'format' => 'raw',
       'header' => 'จำนวนอุบัติการร์ที่เกิดขึ้น',
       'value' => function($model) {
           return '<div class="progress">
                 <div class="progress-bar progress-bar-striped" style="width:'.$model['total'].'%">
               '.$model['total'].' / ครั้ง
             </div>
           </div>';
       },
   ],

 ];
  ?>


      <div class="row">
          <div class="col-md-12">
              <div class="panel panel-info">
                  <div class="panel-heading"><i class="glyphicon glyphicon-stats"></i>&nbsp; รายงานความเสี่ยงแยกตามปีงบประมาน</div>
                  <div class="panel-body">
      <?php
      echo \miloschuman\highcharts\Highcharts::widget([
          'scripts' => [
              'highcharts-3d',
              'modules/drilldown',
              'modules/exporting',
             'themes/sand-signika',
          ],
          'options' => [
              "chart" => [
                  // "type" => "column",
                  // "type" => "pie",
                  // "type" => "bar",
                   "type" => "line",
                  "options3d" => [
                      "enabled" => true,
                      "alpha" => 0
                  ]
              ],
              "title" => [
                  "text" => "รายงานความเสี่ยงแยกตามปีงบประมาน"
              ],
              "subtitle" => [
                  //"text" => "Click the slices to view versions. Source: netmarketshare.com."
              ],
              "plotOptions" => [
                  "pie" => [
                      "innerSize" => 100,
                      "depth" => 45
                  ],
                  "series" => [
                      "dataLabels" => [
                          "enabled" => true,
                          "format" => "{point.name}: {point.y:.1f}%"
                      ]
                  ]
              ],
              "series" => [
                  [
                      "name" => "จำนวนอุบัติการร์ที่เกิดขึ้น",
                      "colorByPoint" => true,
                      "data" => $DataChart,
                  ]
              ],

      ]]);
       ?>
     </div>
   </div>

         <!-- ส่วนแสดง Grid View -->
             <?php
             $fullExportMenu = ExportMenu::widget([
             'dataProvider' => $dataProvider,
               'columns' => $gridColumns,
               'target' => ExportMenu::TARGET_BLANK,
                 'fontAwesome' => true,
                         'asDropdown' => false, // this is important for this case so we just need to get a HTML list
                         'dropdownOptions' => [
                             'label' => '<i class="glyphicon glyphicon-export"></i> Full'
                         ],
                     ]);
                       echo GridView::widget([
                           'dataProvider' => $dataProvider,
                          // 'filterModel' => $searchModel,
                           'id' => 'idofyourpjaxwidget',
                            'pjax'=>true,
                            'pjaxSettings'=>[
                                'neverTimeout'=>true,
                            ],
                           'columns' => $gridColumns,
                           'panel' => [
                               'type' => GridView::TYPE_PRIMARY,
                               'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> รายการอุบัติการความเสี่ยงตามกลุ่มความเสี่ยง</h3>',
                           ],
                           // the toolbar setting is default
                           'toolbar' => [
                               '{export}',
                               ['content'=>
                                   //Html::button('<i class="glyphicon glyphicon-plus"></i>เขียนอุบัติการณ์ความเสี่ยง', ['value' => Url::to(['rm-event/create']),'type'=>'button', 'title'=>Yii::t('kvgrid', 'แบบฟร์อมการลงบันทึกอุบัติการณ์ความเสี่ยง'), 'class'=>'showModalButton btn btn-success']) . ' '.
                                       Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['department'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
                               ],
                           ],
                           // configure your GRID inbuilt export dropdown to include additional items
                           'export' => [
                               'fontAwesome' => true,
                               'itemsAfter'=> [
                                   '<li role="presentation" class="divider"></li>',
                                   '<li class="dropdown-header">Export All Data</li>',
                                   $fullExportMenu
                               ]
                           ],
                       ]);
            ?>
