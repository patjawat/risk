<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use risk\models\RmEvent;
use risk\models\RmArticle;
$event = new RmEvent();
$all = RmEvent::find()->count();
$non = RmEvent::find()->where(['rm_type_id' => 'non-clinic'])->count();
$clinic = RmEvent::find()->where(['rm_type_id' => 'clinic'])->count();
$edit = RmEvent::find()->where(['editing_id' => 2])->count();
$formatter = \Yii::$app->formatter;
 ?>
 <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<?php



// echo $formatter->asPercent().'<br>';

 ?>

 <?php

  ?>


<div class="row">
     <div class="col-md-3">
         <div class="info-box bg-red">
             <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">อุบัติการณ์ความเสี่ยงที่เกิดขึ้นทั้งหมด</span>
                 <span class="info-box-number">
                    <?php echo $all; ?> ครั้ง
                 </span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 12%"></div>
                 </div>
                 <span class="progress-description">
                     <?php echo $formatter->asPercent($all/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
                 </span>
             </div><!-- /.info-box-content -->
         </div><!-- /.info-box -->
     </div>
     <div class="col-md-3">
         <div class="info-box bg-green">
             <span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">อุบัติการณ์ที่เป็นความเสี่ยงทั่วไป</span>
                 <span class="info-box-number">
                     <?php echo $non;?> ครั้ง
                 </span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 53%"></div>
                 </div>
                 <span class="progress-description">
                    <?php echo $formatter->asPercent($non/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
                 </span>
             </div><!-- /.info-box-content -->
         </div><!-- /.info-box -->
     </div>
     <div class="col-md-3">
         <div class="info-box bg-aqua">
             <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">อุบัติการณ์ที่เป็นความเสี่ยงทางคลินิก</span>
                 <span class="info-box-number">
                   <?php echo $clinic;?> ครั้ง
                 </span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 16%"></div>
                 </div>
                 <span class="progress-description">
                     <?php echo $formatter->asPercent($clinic/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
                 </span>
             </div><!-- /.info-box-content -->
         </div><!-- /.info-box -->
     </div>
     <div class="col-md-3">
         <div class="info-box bg-gray">
             <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">อุบัติการณ์ที่ยังไม่ดำเนินการแก้ไข</span>
                 <span class="info-box-number">
                   <?php echo $edit;?> รายการ
                 </span>
                 <div class="progress">
                     <div class="progress-bar" style="width: 17%"></div>
                 </div>
                 <span class="progress-description">
                     <?php echo $formatter->asPercent($edit/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
                 </span>
             </div>
         </div>
     </div>
 </div>
<hr>
<div class="row">
  <div class="col-md-7">
    <div class="ibox float-e-margins ui-sortable">
      <div class="ibox-title"><h5><span class="fa fa-newspaper-o"></span> แสดงรายการเนื้อประชาสัมพันธ์และเนื้อหาอื่น...</h5></div>
      <div class="ibox-content">
        <!-- Custom Tabs -->
         <div class="nav-tabs-custom">
           <ul class="nav nav-tabs">
             <li class="active"><a href="#tab_1" data-toggle="tab">ข่าวประชาสัมพันธ์</a></li>
             <!-- <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
             <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li> -->
             <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
           </ul>
           <div class="tab-content">
             <div class="tab-pane active" id="tab_1">
               <b>How to use:</b>

               <?php
               $dataProvider = new ActiveDataProvider([
                   'query' => RmArticle::find('news'),
                   'pagination' => [
                       'pageSize' => 20,
                   ],
               ]);
               echo GridView::widget([
                   'dataProvider' => $dataProvider,
                   'columns' => [
                       ['class' => 'yii\grid\SerialColumn'],
                       [
                         'attribute'=>'เผยแพร่',
                         'value' => function($model){
                           return Yii::$app->thaiFormatter->asDate($model->created_at, 'php:d/m/Y');
                         }
                       ],
                       'name',
                       [
                           'class' => 'yii\grid\DataColumn',
                           'format' => 'html',
                           'value' => function ($data) {
                               return Html::a('เพิ่มเติม', ['/rm/rm-article/view', 'id' => $data->id], ['class' => '']);
                           },
                       ],
                   ],
               ]);
                ?>
             </div>
             <div class="tab-pane" id="tab_2">
             </div>
             <div class="tab-pane" id="tab_3">
             </div>
           </div>
         </div>>
    </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="ibox float-e-margins ui-sortable">
      <div class="ibox-title"><h5><span class="fa fa-newspaper-o"></span> แสดงรายการความเสี่ยงแยกรายปี...</h5></div>
      <div class="ibox-content">
        <div class="" id="container">

        </div>

  </div>
</div>
  </div>
</div>




      <!-- <div id="con1" style="min-width: 400px; height: 400px; margin: 0 auto"></div> -->
<?php
$sql_year = "SELECT YEAR(event_date) as y,COUNT(id) as total FROM rm_event GROUP BY YEAR(event_date)";
$command_year = Yii::$app->risk->createCommand($sql_year)->queryAll();

foreach ($command_year as $model) {
  $data_year[] = [
    'name' => $model['y'],
    'y' => $model['total']*1,
    'drilldown' => $model['y']
  ];
}
foreach ($command_year as $model) {
  $data_month[] = [
    'name' => $model['y'],
    'id' => $model['y'],
    'data' => $event->month($model['y'])
  ];
}

$year  = json_encode($data_year);
$month  = json_encode($data_month);
 ?>
<?php
$js = <<< JS
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'สถิติการเกิดอุบัติการณ์ความเสี่ยงโรงพยาบาลโนนสัง'
    },
    subtitle: {
        text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'ระดับจำนวนที่เกิดขึ้น'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [{
        name: 'จำนวนความเสี่ยง',
        colorByPoint: true,
        data: $year,
    }],
    drilldown: {
        series: $month,
    }
});
JS;
$this->registerJS($js);
?>
