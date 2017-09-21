<?php
use risk\models\RmEvent;
 ?>
 <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">อุบัติการณ์ทั้งหมด</span>
        <span class="info-box-number"><?=RmEvent::find()->count();?> ครั้ง</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
            <span class="progress-description">
              70% Increase in 30 Days
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">รอการทบทวน</span>
        <span class="info-box-number"><?=RmEvent::find()->where(['review_date' => null])->count();?> ครั้ง</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
            <span class="progress-description">
              70% Increase in 30 Days
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bookmarks</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
          </div>
        </div>
      </div>
      <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
      <!-- <div id="con1" style="min-width: 400px; height: 400px; margin: 0 auto"></div> -->

<?php
$js = <<< JS
// Create the chart
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
                   '2559',
                   '2560'
               ]
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
               name: 'ความเสียงทั่วไป',
               data: [{y:49.9,
                 drilldown:'ny 2'
               },71]

           }, {
               name: 'ความเสียงทางคลินิก',
               data: [
                 {y:49.9,
                   drilldown:'ny 1'
                 },55]

           }],
           drilldown:{
               series: [
               {name:'มกราคม',
                   id: 'ny 1',
                   data: [{y:39.9, name:'name1'}, {y:31.5, name:'name2'}]

               }, {name:'มีนาคม',
                   id: 'ny 1',
                   data: [{y:39.9, name:'name1'}, {y:31.5, name:'name2'}]

               }, {name:'เมษายน',
                   id: 'ny 1',
                   data: [{y:39.9, name:'name1'}, {y:31.5, name:'name2'}]

               }]
             }

});
JS;
$this->registerJS($js);
?>
