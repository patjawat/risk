<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yac\ajaxModal\ajaxModal;
use risk\models\RmEvent;
use yii\web\JsExpression;
use daixianceng\echarts\ECharts;
ECharts::$dist = ECharts::DIST_FULL;
ECharts::registerTheme('dark');
$this->title = "รายงานอุบติการณ์ความเสี่ยง";
$params = [':date1' => $searchModel->date1,'date2' => $searchModel->date2];
 ?>
  <?php Pjax::begin(['enablePushState' => false]); ?>
  <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
  <div id="container" style="height: 100%;width:100%;"></div>
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
var dom = document.getElementById("container");
var myChart = echarts.init(dom);
var app = {};
option = null;
option = {
    title : {
        text: '某站点用户访问来源',
        subtext: '纯属虚构',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'直接访问'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1548, name:'搜索引擎'}
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
JS;
$this->registerJS($js);
 ?>
    <?php Pjax::end(); ?>
