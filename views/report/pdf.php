<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yac\ajaxModal\ajaxModal;
use risk\models\RmEvent;
$title = "รายงานอุบติการณ์ความเสี่ยง";
 ?>
 <style media="screen">
  .table{
    font-family: "thsaraban","Helvetica Neue", Helvetica, Arial, sans-serif;
  }
  .logo-header{
    margin-left: 300px;
  }

 </style>

 <?php Pjax::begin(['enablePushState' => false]); ?>
  <?php //Pjax::begin(); ?>
 <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

 <div id="PrintThis" style="background-color:#ffffff;">

<!-- <link rel="stylesheet" href="css/pdf.css" /> -->

<?php //echo Html::img('@web/images/gpo.png',['width' => 100,'class' => 'logo-header']); ?>

<!-- <p class="p-title">รายการอุบัติการณ์/ความเสี่ยง<br>โรงพยาบาลโนนสัง จังหวัดหนองบัวลำภู ปีงบประมาณ  2560 </p> -->
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
   <?php Pjax::end(); ?>
 </div>
