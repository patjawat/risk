<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yac\ajaxModal\ajaxModal;
use risk\models\RmEvent;
use miloschuman\highcharts\HighchartsAsset;
// HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);
HighchartsAsset::register($this)->withScripts(['modules/exporting', 'modules/drilldown']);
$title = "รายงานอุบติการณ์ความเสี่ยง";
$params = [':date1' => $searchModel->date1,'date2' => $searchModel->date2];
 ?>
  <?php Pjax::begin(['enablePushState' => false]); ?>
  <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><span class="glyphicon glyphicon-signal"></span>สรุปตามการทบทวน</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
                $sql_edit1 = "SELECT COUNT(e.id) as total FROM rm_event e
                  LEFT OUTER JOIN rm_type t ON t.id = e.rm_type_id
                  LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
                  LEFT OUTER JOIN rm_level l ON l.id = e.rm_level_id
                  WHERE e.event_date BETWEEN :date1 AND :date2
                  AND e.editing_id = 1";
                  $sql_edit2 = "SELECT COUNT(e.id) as total FROM rm_event e
                    LEFT OUTER JOIN rm_type t ON t.id = e.rm_type_id
                    LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
                    LEFT OUTER JOIN rm_level l ON l.id = e.rm_level_id
                    WHERE e.event_date BETWEEN :date1 AND :date2
                    AND e.editing_id = 2";
                    if ($searchModel->date1) {
                      $query_edit1 = Yii::$app->risk->createCommand($sql_edit1,$params)->queryScalar();
                      $query_edit2 = Yii::$app->risk->createCommand($sql_edit2,$params)->queryScalar();
                    }else {
                        $query_edit1 = "";
                        $query_edit2 = "";
                    }

               ?>
            <div id="container" style="max-width: 900px; height: 300px; margin: 0 auto"></div>
            </div>
            <!-- /.box-body -->
          </div>

  </div>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><span class="fa fa-medkit"></span>สรุปตามประเภทความเสี่ยงและโปรแกรมความเสี่ยง</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              The body of the box
            </div>
            <?php
              $sql_non_level = "SELECT id as id,
              (SELECT count(id) FROM rm_event e WHERE e.event_date BETWEEN :date1 AND  :date2 AND rm_level_id = l.id) as total
               FROM rm_level l WHERE l.rm_type_id = 'non-clinic' GROUP BY id ASC";
               $sql_clinic_level = "SELECT id as id,
               (SELECT count(id) FROM rm_event e WHERE e.event_date BETWEEN :date1 AND  :date2 AND rm_level_id = l.id) as total
                FROM rm_level l WHERE l.rm_type_id = 'clinic' GROUP BY id ASC";
                  //$review = "";
              $command_non_level = Yii::$app->risk->createCommand($sql_non_level,$params)->queryAll();
              $command_clinic_level = Yii::$app->risk->createCommand($sql_clinic_level,$params)->queryAll();
              foreach ($command_non_level as  $model) {
                $level_non[] = [
                      'name' => $model['id'],
                      'y' => $model['total']*1
                ];
              }
              foreach ($command_clinic_level as  $model) {
                $level_clinic[] = [
                      'name' => $model['id'],
                      'y' => $model['total']*1
                ];
              }
              $level_clinic_data = json_encode($level_clinic);
              $level_non_data = json_encode($level_non);
             ?>
          <div id="container_level" style="min-width: 310px; height: 300px; max-width: 600px; margin: 0 auto"></div>
          </div>

  </div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><span class="fa fa-medkit"></span>สรุปตามประเภทความเสี่ยงและโปรแกรมความเสี่ยง</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
  <?php
    $sql_type = "SELECT t.name as name,COUNT(e.id) as total FROM rm_event e
      LEFT OUTER JOIN rm_type t ON t.id = e.rm_type_id
      LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
      LEFT OUTER JOIN rm_level l ON l.id = e.rm_level_id
      WHERE e.event_date BETWEEN :date1 AND :date2
      GROUP BY t.id";
      $command_type = Yii::$app->risk->createCommand($sql_type,$params)->queryAll();
      $rm_type= "";
      foreach ($command_type as  $model) {
        $rm_type[] = [
              'name' => $model['name'],
              'y' => $model['total']*1
        ];
      }

      $sql_group = "SELECT g.name as name,COUNT(e.id) as total FROM rm_event e
        LEFT OUTER JOIN rm_type t ON t.id = e.rm_type_id
        LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
        LEFT OUTER JOIN rm_level l ON l.id = e.rm_level_id
        WHERE e.event_date BETWEEN :date1 AND :date2
        GROUP BY g.id";
        $command_group_label = Yii::$app->risk->createCommand($sql_group,$params)->queryAll();
        $rm_group_label = "";
        foreach ($command_group_label as  $model) {
          $rm_group_label[] = [
               $model['name'],
          ];
        }

        $command_group = Yii::$app->risk->createCommand($sql_group,$params)->queryAll();
        $rm_group = "";
        foreach ($command_group as  $model) {
          $rm_group[] = [
               $model['total']*1,

          ];
        }

      $type_data = json_encode($rm_type);
      $group_data = json_encode($rm_group);
      $group_data_label = json_encode($rm_group_label);
   ?>
   <div id="container_group" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
</div>
</div>
</div>

  
  <?php //Pjax::begin(); ?>
 <div id="PrintThis" style="background-color:#ffffff;">
<?php //echo Html::img('@web/images/gpo.png',['width' => 100,'class' => 'logo-header']); ?>
<!-- <p class="p-title">รายการอุบัติการณ์/ความเสี่ยง<br>โรงพยาบาลโนนสัง จังหวัดหนองบัวลำภู ปีงบประมาณ  2560 </p> -->
<?php if ($searchModel->date1): ?>
<table class="table table-bordered">
   	<thead style="background-color:#BDC3C7; color:#ffffff;">
   		<tr>
   			<td align="center" rowspan="2"><br>#</td>
   			<td align="center" rowspan="2"><br>โปรแกรม /ประเด็นความเสี่ยง อุบัติการณ์</td>
   			<td align="center" rowspan="2"><br>ประเภท</td>
   			<td align="center" colspan="13">จำนวนครั้งที่เกิด</td>
   			<td align="center" rowspan="2"><br>รวม</td>
   			<td align="center" colspan="2">การทบทวน</td>
   		</tr>
      <tr>
   			<td align="center">A</td>
   			<td align="center">B</td>
   			<td align="center">C</td>
   			<td align="center">D</td>
   			<td align="center">E</td>
   			<td align="center">F</td>
   			<td align="center">G</td>
   			<td align="center">H</td>
   			<td align="center">I</td>
        <td align="center">1</td>
        <td align="center">2</td>
        <td align="center">3</td>
        <td align="center">4</td>
        <td align="center">แก้ไขแล้ว</td>
   			<td align="center">ยังไม่แก้ไข</td>
   		</tr>
	</thead>
<tbody>
  <?php $i = 1;?>
  <?php foreach ($dataProvider->getModels() as $model): ?>
   		<tr style="background-color:#eee;">
   			<td><?=$i++;?></td>
   			<td><?=$model->rmItems->rmGroup->name;?></td>
   			<td align="center"><?=$model->rm_type_id;?></td>
   			<td></td>
   			<td></td>
   			<td></td>
   			<td></td>
   			<td></td>
   			<td></td>
   			<td></td>
   			<td></td>
   			<td></td>
   			<td></td>
        <td></td>
   			<td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
   		</tr>
      <?php
      $i_sub = 0;
        $SubQuery =  RmEvent::find()
        ->where(['rm_group_id' => $model->rmItems->rmGroup->id])
        ->groupby('rm_items_id')->all();
       ?>
      <?php foreach ($SubQuery as $sub): ?>
      <tr>
   			<td>-</td>
        <td><?=$sub->rmItems->name?></td>
   			<td align="center"><?=$sub->rm_type_id;?></td>
   			<td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'A'])->count('id');?></td>
   			<td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'B'])->count('id');?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'C'])->count('id');?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'D'])->count();?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'E'])->count();?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'F'])->count();?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'G'])->count();?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'H'])->count();?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => 'I'])->count('id');?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => '1'])->count('id');?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => '2'])->count('id');?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => '3'])->count('id');?></td>
        <td align="center">  <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'rm_level_id' => '4'])->count('id');?></td>
   			<td align="center"> <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id])->count('id');?></td>
   			<td align="center"> <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'editing_id' => 1])->count('id');?></td>
   			<td align="center"> <?=RmEvent::find()->where(['rm_items_id'=> $sub->rm_items_id,'rm_group_id' => $sub->rmItems->rmGroup->id,'editing_id' => 2])->count('id');?></td>
        <?php endforeach; ?>
   		</tr>
      <?php endforeach; ?>
   	</tbody>
   </table>
 <?php else: ?>
  <?php echo $this->render( '@frontend/modules/rm/views/off'); ?>
<?php endif; ?>
 </div>
<?php
$js = <<< JS
// สรุปตามการทบทวน
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'สรุปการทบทวน',
        align: 'center',
        verticalAlign: 'middle',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Browser share',
        innerSize: '50%',
        data: [
            ['ทบทวนแล้ว',   $query_edit2],
            ['รอการทบทวน',      $query_edit1],
            {
                name: 'Proprietary or Undetectable',
                y: 0.2,
                dataLabels: {
                    enabled: false
                }
            }
        ]
    }]
});
// สรุปตามโปรแกรมความเสี่ยง
Highcharts.chart('container_group', {
  colors: ['#2980b9', '#ED561B', '#DDDF00', '#24CBE5', '#64E572'],
    title: {
        text: 'สรุปตามประเภทความเสี่ยงและโปรแกรมความเสี่ยง'
    },
    xAxis: {
        categories: $group_data_label
    },
    labels: {
        items: [{
            html: 'ประเภทความเสี่ยง',
            style: {
                left: '50px',
                top: '18px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
    },
    series: [{
        type: 'column',
        name: 'โปรแกรมความเสี่ยง',
        data: $group_data
    }, {
        type: 'spline',
        name: 'ค่าเฉลี่ย',
        data: $group_data,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }, {
        type: 'pie',
        colors: ['#16a085', '#ED561B', '#DDDF00', '#24CBE5', '#64E572'],
        name: 'Total consumption',
        data: $type_data,
        center: [100, 80],
        size: 100,
        showInLegend: false,
        dataLabels: {
            enabled: false
        }
    }]
});
// สรุปตามระดับความรุนแรง
Highcharts.chart('container_level', {
       chart: {
           plotBackgroundColor: null,
           plotBorderWidth: null,
           plotShadow: false,
           type: 'column'
       },
       title: {
           text: 'สรุปตามระดับความรุนแรงทั่งไป และ ทางคลินิก'
       },
       xAxis: {
      type: 'category'
  },
       tooltip: {
           pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
       },
       plotOptions: {
           pie: {
               allowPointSelect: true,
               cursor: 'pointer',
               dataLabels: {
                   enabled: false
               },
               showInLegend: true
           }
       },
       series: [{
           name: 'ความเสี่ยงทั่วไป',
           colorByPoint: true,
           data: $level_non_data
       },
       {
           name: 'ความเสี่ยงทางคลินิก',
           colorByPoint: true,
           data: $level_clinic_data
       }]
   });

JS;
$this->registerJS($js);
 ?>
    <?php Pjax::end(); ?>
