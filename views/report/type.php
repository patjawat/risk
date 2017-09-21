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

 <?php $form = ActiveForm::begin([
    //    'action' => ['report'],
        'method' => 'post',
    ]); ?>


    <div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'date1')->widget(DatePicker::ClassName(),
    [
    'name' => 'check_issue_date',
    'options' => ['placeholder' => 'Select date ...'],
    'pluginOptions' => [
    	'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
    ]
]);?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'date2')->widget(DatePicker::ClassName(),
    [
    'name' => 'check_issue_date',
    'options' => ['placeholder' => 'Select date ...'],
    'pluginOptions' => [
    	'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
    ]
]);?>
    </div>
    <div class="col-md-3">
      <?php
      echo $form->field($model, 'type')->widget(Select2::classname(), [
        'data' => ['1' => 'ประเภทความเสี่ยง','2' => 'กลุ่มความเสี่ยง','3' => 'รายการความเสี่ยง','4' =>'แผนก-ฝ่าย' ],
        'language' => 'th',
        'options' => ['placeholder' => 'Select...','id' => 'rm_department_id'],
        'pluginOptions' => [
        'allowClear' => true
        ],
        ]);
        ?>
   </div>
    <div class="col-md-3">
    	<div class="form-group" style="padding-top:25px;">
        <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-info  glyphicon glyphicon-search']) ?>
        <?php
?>
    </div>
    </div>


</div>
    <?php ActiveForm::end(); ?>

 <?php
 $gridColumns = [
   ['class' => 'kartik\grid\SerialColumn'],
   [
       'attribute' => 'name',
       'value' => function($model) {return $model['year'];},
       'header' => 'ชื่อรายการ',
        'width' => '150px',
        'value' => function($model) {
          return $model['name'];
        }
    ],
    [
       'attribute' => 'total',
       'format' => 'raw',
       'header' => 'จำนวนอุบัติการร์ที่เกิดขึ้น',
       'value' => function($model) {
          //  return '<div class="progress">
          //        <div class="progress-bar progress-bar-striped" style="width:'.$model['total'].'%">
          //      '.$model['total'].' / ครั้ง
          //    </div>
          //  </div>';
          return '<div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: '.$model['total'].'%">
                              <span class="sr-only">20% Complete</span>
                              '.$model['total'].' / ครั้ง
                            </div>
                          </div>';
       },
   ],

 ];
  ?>

<div class="rows">
  <div class="col-md-6">
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
                               'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> รายการอุบัติการความเสี่ยง</h3>',
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

          </div>
          <div class="col-md-6">

            <div class="panel panel-primary">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">Chart Data</h3>
                                    </div>
                                    <div class="panel-body">

            <?php
            echo \miloschuman\highcharts\Highcharts::widget([
                'scripts' => [
                    //'highcharts-3d',
                    'modules/drilldown',
                    'modules/exporting',
                  //  'themes/sand-signika',
                   'themes/grid-light',
                ],
                'options' => [
                    "chart" => [
                        // "type" => "column",
                         "type" => "pie",
                        // "type" => "bar",
                        // "type" => "line",
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
                                "format" => "{point.name}: {point.y:.f} ครั้ง"
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
           </div>
         </div>
