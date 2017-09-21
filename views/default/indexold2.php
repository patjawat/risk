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
      <div id="con1" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
      <?php
      // $clinic = Yii::$app->risk->createCommand("SELECT
      // COUNT(id) as total,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 1 AND	rm_type_id = 'clinic') as m1,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 2 AND	rm_type_id = 'clinic') as m2,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 3 AND	rm_type_id = 'clinic') as m3,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 4 AND	rm_type_id = 'clinic') as m4,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 5 AND	rm_type_id = 'clinic') as m5,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 6 AND	rm_type_id = 'clinic') as m6,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 7 AND	rm_type_id = 'clinic') as m7,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 8 AND	rm_type_id = 'clinic') as m8,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 9 AND	rm_type_id = 'clinic') as m9,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 10 AND	rm_type_id = 'clinic') as m10,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 11 AND	rm_type_id = 'clinic') as m11,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 12 AND	rm_type_id = 'clinic') as m12
      // FROM  rm_event WHERE rm_type_id = 'clinic'")->queryAll();
      // $non_clinic = Yii::$app->risk->createCommand("SELECT
      // COUNT(id) as total,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 1 AND	rm_type_id = 'non-clinic') as m1,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 2 AND	rm_type_id = 'non-clinic') as m2,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 3 AND	rm_type_id = 'non-clinic') as m3,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 4 AND	rm_type_id = 'non-clinic') as m4,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 5 AND	rm_type_id = 'non-clinic') as m5,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 6 AND	rm_type_id = 'non-clinic') as m6,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 7 AND	rm_type_id = 'non-clinic') as m7,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 8 AND	rm_type_id = 'non-clinic') as m8,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 9 AND	rm_type_id = 'non-clinic') as m9,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 10 AND	rm_type_id = 'non-clinic') as m10,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 11 AND	rm_type_id = 'non-clinic') as m11,
      // (SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 12 AND	rm_type_id = 'non-clinic') as m12
      // FROM  rm_event WHERE rm_type_id = 'non-clinic'")->queryAll();
      //
      // $data_clinic = [];
      // foreach ($clinic as $querys) {
      //   $data_clinic = [
      //     $querys['m1']*1,
      //     $querys['m2']*1,
      //     $querys['m3']*1,
      //     $querys['m4']*1,
      //     $querys['m5']*1,
      //     $querys['m6']*1,
      //     $querys['m7']*1,
      //     $querys['m8']*1,
      //     $querys['m9']*1,
      //     $querys['m10']*1,
      //     $querys['m11']*1,
      //     $querys['m12']*1,
      //   ];
      // }
      //
      // $data_non_clinic = [];
      // foreach ($non_clinic as $querys) {
      //   $data_non_clinic = [
      //     $querys['m1']*1,
      //     $querys['m2']*1,
      //     $querys['m3']*1,
      //     $querys['m4']*1,
      //     $querys['m5']*1,
      //     $querys['m6']*1,
      //     $querys['m7']*1,
      //     $querys['m8']*1,
      //     $querys['m9']*1,
      //     $querys['m10']*1,
      //     $querys['m11']*1,
      //     $querys['m12']*1,
      //   ];
      // }
      //
      // // รวมรายปี
      // $sql_year = Yii::$app->risk->createCommand("SELECT YEAR(event_date) as y,COUNT(id) as total FROM rm_event
      // GROUP BY YEAR(event_date)")->queryAll();
      // $main_clinic = json_encode($data_clinic);
      // $main_non_clinic = json_encode($data_non_clinic);
       ?>







<?php
$js = <<< JS
// Highcharts.chart('container', {
//   chart: {
//           type: 'column'
//       },
// title: {
//     text: 'อัตราความเสี่ยงแยกรายเดือน'
// },
// subtitle: {
//     text: ''
// },
// xAxis: {
//     categories: ['ม.ค.', 'ก.พ.', 'ม๊.ค.', 'เม.ย.', 'พ.ย.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
// },
// yAxis: {
//     title: {
//         text: 'Temperature (°C)'
//     }
// },
// plotOptions: {
//         line: {
//             dataLabels: {
//                 enabled: true
//             },
//             enableMouseTracking: false
//         }
//     },
//     series: [{
//         name: 'ความเสี่ยงทางคลินิก',
//         data: $main_clinic
//     },
//     {
//         name: 'ความเสี่ยงทั่วไป',
//         data: $main_non_clinic
//     }
//   ]
// });
//
$(function () {
        var chart;
        $(document).ready(function () {
            var colors = Highcharts.getOptions().colors,
            categories1 = ['1011', '1112', '1213', '1415'],
            name1 = 'Actual',

            data1 = [
{
     y: 1674,
     color: colors[0],
     drilldown: {
         name: '1011 Actual',
         categories: ['BS', 'B', 'IT', 'C'],
         data: [3, 32, 54, 50],

         color: colors[0],

         name1: '1011 Target',
         data1: [0, 31, 50, 60],
         color1:colors[1]
     }
 }
];            var colors = Highcharts.getOptions().colors,
            categories2 = ['1011', '1112', '1213', '1415'],
            name2 = 'Target',

            data2 = [
{
     y: 1633,
     color: colors[1],
     drilldown: {
          name: '1011 Actual',
         categories: ['BS', 'B', 'IT', 'C'],
         data: [3, 32, 54, 50],

         color: colors[0],

         name1: '1011 Target',
         data1: [0, 31, 50, 60],
         color1:colors[1]
     }
 }
];            function setChart(name, categories, data, color) {
                console.log(name, categories, data, color);
                chart.xAxis[0].setCategories(categories);
                while (chart.series.length > 0) {
                    chart.series[0].remove(true);
                }
                for (var i = 0; i < data.length; i++) {
                    chart.addSeries({
                        name: name[i],
                        data: data[i],
                        color: color[i]
                    });

                }
            }
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'con1',
                    type: 'column'
                },
                title: {
                    text: 'Learner Responsive 16-18'
                },
                subtitle: {
                    text: 'Click the columns to view breakdown by department. Click again to view by Academic Year.'
                },
                xAxis: {
                    categories: categories1
                    , labels: {rotation:-90, align:'right'}
                },
                yAxis: {
                    title: {
                        text: 'Learner Responsive 16-18'
                    }
                },

                plotOptions: {
                    column: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function () {
                                    var drilldown = this.drilldown;
                                    if (drilldown) { // drill down
                                        setChart([drilldown.name,drilldown.name1], drilldown.categories, [drilldown.data, drilldown.data1], [drilldown.color,drilldown.color1]);
                                    } else { // restore
                                        setChart(name, categories1, [data1, data2], 'white');
                                    }
                                }
                            }
                        },

                        dataLabels: {
                            enabled: true,
                            color: colors[0],
                            style: {
                                fontWeight: 'bold'
                            },
                            formatter: function () {
                                return this.y; // +'%';
                            }
                        }
                    }
                },

                tooltip: {
                    formatter: function () {
                        var point = this.point,
                        series = point.series,
                        s = 'Learner Responsive 16-18' + '<br/>' + this.x + ' ' + series.name + ' is <b>' + this.y + '</b><br/>';
                        if (point.drilldown) {
                            s += 'Click to view <b>' + point.category + ' ' + series.name + ' </b>' + ' by department';
                        } else {
                            s += 'Click to return to view by academic year.';
                        }
                        return s;
                    }
                },

                series: [{
                    name: name1,
                    data: data1,
                    color: colors[0]
                },{
                    name: name2,
                    data: data2,
                    color: colors[1]
                }],

                exporting: {
                    enabled: false
                }
            },
                function (chart) {
                console.log(chart);
            });
        });
    });
JS;
$this->registerJS($js);
?>
