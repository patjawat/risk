<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use kartik\growl\Growl;
use kartik\export\ExportMenu;
use risk\models\RmItems;
use risk\models\RmDepartment;
 ?>
 <?php
 if($model->date1 && $model->date2 !==""){
   echo Growl::widget([
       'type' => Growl::TYPE_SUCCESS,
       'icon' => 'glyphicon glyphicon-ok-sign',
       'title' => 'สถานะการทำงาน',
       'showSeparator' => true,
       'body' => 'ประมวลผลเสร็จสมบรูณ์ <br>ข้อมูลตั้งแต่ วันที่&nbsp'.$model->date1.'&nbspถึงวันที่&nbsp'.$model->date2
   ]);
 }
 ?>
 <?php

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
    	<div class="form-group" style="padding-top:25px;">
        <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-info  glyphicon glyphicon-search']) ?>
        <?php
?>
    </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
<?php if ($model->date1 ==  null): ?>
<?php echo $this->render( '@frontend/modules/rm/views/off'); ?>
<?php else: ?>
  <div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-stats"></i>&nbsp;
              รายงานความเสี่ยงตามโปรแกรมความเสี่ยง

            </div>
            <div class="panel-body" style="height:autopx;">
    <?php   echo \miloschuman\highcharts\Highcharts::widget([
      'scripts' => [
          //'highcharts-3d',
          'modules/drilldown',
          'modules/exporting',
         'themes/sand-signika',
      ],
      'options' => [
          "chart" => [
               "type" => "column",
              // "type" => "pie",
              // "type" => "bar",
              // "type" => "line",
              "options3d" => [
                  "enabled" => true,
                  "alpha" => 0
              ]
          ],
          "title" => [
              "text" => "รายงานความเสี่ยงตามโปรแกรมความเสี่ยง"
          ],
          "subtitle" => [
              "text" => 'ข้อมูลของวันที่ '.Yii::$app->formatter->asDate($model->date1, 'dd/MM/yyyy').' ถึงวันที่ '.Yii::$app->formatter->asDate($model->date2, 'dd/MM/yyyy')
          ],
          "plotOptions" => [
              "pie" => [
                  "innerSize" => 100,
                  "depth" => 45
              ],
              "series" => [
                  "dataLabels" => [
                      //"enabled" => true,
                      "format" => "{point.name}: {point.y:.1f}%"
                  ],
                  'colorByPoint'=> true,
                  'data'=> 'brandsData'
              ]
          ],
          'tooltip' => [
          'headerFormat'=> '<span style="font-size:11px">{series.name}</span><br>',
          'pointFormat'=> '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} </b> ครั้ง<br/>'
       ],
       'xAxis' => [
          'type'=> 'category'
       ],
       'yAxis' =>[
          'title'=> [
            'text'=> 'Total percent market share'
          ]
       ],
          "series" => [
              [
                  "name" => "รายงานแยกตามโปรแกรมความเสี่ยง",
                  "colorByPoint" => true,
                  "data" => $main_data,
              ]
          ],
          "drilldown" => [
            "series" => $sub,
          ]
    ]]);
    ?>
    </div>
    </div>
    </div>

      <div class="col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading"><i class="glyphicon glyphicon-stats"></i>&nbsp;
                รายงานความเสี่ยงตามระดับความรุนแรง

              </div>
              <div class="panel-body" style="height:auto;">
    <?php   echo \miloschuman\highcharts\Highcharts::widget([
        'scripts' => [
            //'highcharts-3d',
            'modules/drilldown',
            'modules/exporting',
           'themes/sand-signika',
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
                "text" => "รายงานความเสี่ยงตามระดับความรุนแรง"
            ],
            "subtitle" => [
                "text" => 'ข้อมูลของวันที่ '.Yii::$app->formatter->asDate($model->date1, 'dd/MM/yyyy').' ถึงวันที่ '.Yii::$app->formatter->asDate($model->date2, 'dd/MM/yyyy')
            ],
            "plotOptions" => [
                "pie" => [
                    "innerSize" => 100,
                    "depth" => 45
                ],
                "series" => [
                    "dataLabels" => [
                        //"enabled" => true,
                        "format" => "{point.name}: {point.y:.1f}%"
                    ],
                    'colorByPoint'=> true,
                    'data'=> 'brandsData'
                ]
            ],
            'tooltip' => [
            'headerFormat'=> '<span style="font-size:11px">{series.name}</span><br>',
            'pointFormat'=> '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} </b> ครั้ง<br/>'
         ],
         'xAxis' => [
            'type'=> 'category'
         ],
         'yAxis' =>[
            'title'=> [
              'text'=> 'Total percent market share'
            ]
         ],
            "series" => [
                [
                    "name" => "รายงานแยกตามระดับความรุนแรง",
                    "colorByPoint" => true,
                    "data" => $level,
                ]
            ],
            "drilldown" => [
              "series" => $sub,
            ]
    ]]);
     ?><br>
   </div>
 </div>
 </div>
  </div>

  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-stats"></i>&nbsp;
              รายงานความเสี่ยงตามรายการความเสี่ยง
            </div>
          </div>
            <div class="panel-body" style="height:auto;">
    <?php   echo \miloschuman\highcharts\Highcharts::widget([
      'scripts' => [
          //'highcharts-3d',
          'modules/drilldown',
          'modules/exporting',
         'themes/sand-signika',
      ],
      'options' => [
          "chart" => [
               "type" => "column",
              // "type" => "pie",
              // "type" => "bar",
              // "type" => "line",
              "options3d" => [
                  "enabled" => true,
                  "alpha" => 0
              ]
          ],
          "title" => [
              "text" => "รายงานความเสี่ยงตามกรายการความเสี่ยง"
          ],
          "subtitle" => [
              "text" => 'ข้อมูลของวันที่ '.Yii::$app->formatter->asDate($model->date1, 'dd/MM/yyyy').' ถึงวันที่ '.Yii::$app->formatter->asDate($model->date2, 'dd/MM/yyyy')
          ],
          "plotOptions" => [
              "pie" => [
                  "innerSize" => 100,
                  "depth" => 45
              ],
              "series" => [
                  "dataLabels" => [
                      //"enabled" => true,
                      "format" => "{point.name}: {point.y:.1f}%"
                  ],
                  'colorByPoint'=> true,
                  'data'=> 'brandsData'
              ]
          ],
          'tooltip' => [
          'headerFormat'=> '<span style="font-size:11px">{series.name}</span><br>',
          'pointFormat'=> '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} </b> ครั้ง<br/>'
       ],
       'xAxis' => [
          'type'=> 'category'
       ],
       'yAxis' =>[
          'title'=> [
            'text'=> 'Total percent market share'
          ]
       ],
          "series" => [
              [
                  "name" => "รายงานแยกตามรายการความเสี่ยง",
                  "colorByPoint" => true,
                  "data" => $items,
              ]
          ],

    ]]);
    ?>
    <!-- ส่วนแสดง Grid View -->


  </div>
  </div>
  </div>



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
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> รายการอุบัติการความเสี่ยงตามโปรแกรมความเสี่ยง</h3>',
                ],
                // the toolbar setting is default
                'toolbar' => [
                    '{export}',
                    ['content'=>
                        //Html::button('<i class="glyphicon glyphicon-plus"></i>เขียนอุบัติการณ์ความเสี่ยง', ['value' => Url::to(['rm-event/create']),'type'=>'button', 'title'=>Yii::t('kvgrid', 'แบบฟร์อมการลงบันทึกอุบัติการณ์ความเสี่ยง'), 'class'=>'showModalButton btn btn-success']) . ' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
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
   <?php endif; ?>
