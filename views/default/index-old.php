<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\grid\GridView;s
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
use yii\helpers\Json;
//Model
use risk\models\RmDepartment;
use risk\models\RmType;
use risk\models\RmGroup;
use risk\models\Rmitems;
use risk\models\RmLevel;
use risk\models\RmLevelgroup;
use risk\models\RmEvent;
use risk\models\RmArticle;

//HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);

$this->title = 'โปรแกรมบริหารความเสี่ยง';
?>
<style media="screen">
.modal-dialog{
  width:80%;
}


</style>


<div class="row">
  <div class="col-md-12">
    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Removable</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>

            <div class="box-body">
              <script src="https://code.highcharts.com/highcharts.js"></script>
          <script src="https://code.highcharts.com/modules/exporting.js"></script>
          <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

            </div>
            <!-- /.box-body -->
          </div>

  </div>
</div><br>
<div class="row">
  <div class="col-md-4">
    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">ระดับความเสี่ยง</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">



    <div class="info-box bg-red">
             <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">XXX</span>
                 <span class="info-box-number">
                     1 ครั้ง
                 </span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 100%"></div>
                 </div>
                 <span class="progress-description">
                     100% ของจำนวนทั้งหมด
                 </span>
             </div><!-- /.info-box-content -->
         </div>
         <div class="info-box bg-green">
             <span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">XXX</span>
                 <span class="info-box-number">
                     0 ครั้ง
                 </span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 0%"></div>
                 </div>
                 <span class="progress-description">
                     0% ของจำนวนทั้งหมด
                 </span>
             </div><!-- /.info-box-content -->
         </div>
         <div class="info-box bg-aqua">
             <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">XXX</span>
                 <span class="info-box-number">0 ครั้ง</span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 0%"></div>
                 </div>
                 <span class="progress-description">
                     0% ของจำนวนทั้งหมด
                 </span>
             </div><!-- /.info-box-content -->
         </div>
         <div class="info-box bg-gray">
             <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">XXX</span>
                 <span class="info-box-number">0 ครั้ง</span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 0%"></div>
                 </div>
                 <span class="progress-description">
                     0% ของจำนวนทั้งหมด
                 </span>
             </div><!-- /.info-box-content -->
         </div>

         </div>
         <!-- /.box-body -->
       </div>


  </div>
  <div class="col-md-8">
    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">ประชาสัมพันธ์</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false">ข่าวประชาสัมพันธ์</a></li>
                <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="true">กิจกรรม</a></li>
                <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Dropdown <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                  </ul>
                </li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="tab_1">
                  <b>How to use:</b>

                  <p>Exactly like the original bootstrap tabs except you should use
                    the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                  A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.
                  I am alone, and feel the charm of existence in this spot,
                  which was created for the bliss of souls like mine. I am so happy,
                  my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                  that I neglect my talents. I should be incapable of drawing a single stroke
                  at the present moment; and yet I feel that I never was a greater artist than now.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_2">
                  The European languages are members of the same family. Their separate existence is a myth.
                  For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                  in their grammar, their pronunciation and their most common words. Everyone realizes why a
                  new common language would be desirable: one could refuse to pay expensive translators. To
                  achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                  words. If several languages coalesce, the grammar of the resulting language is more simple
                  and regular than that of the individual languages.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                  Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                  when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                  It has survived not only five centuries, but also the leap into electronic typesetting,
                  remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                  sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                  like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
</div>


<?php
$js = <<< JS
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });
});


JS;
$this->registerJs($js);

 ?>
