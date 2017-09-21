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
use yii\widgets\MaskedInput;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use risk\models\RmEvent;
?>
<style media="screen">
.sum{
  background-color:#9B59B6 ;
  color: #FFFFFF;
}
.sum-all{
  background-color:#9B59B6;
  color: #FFFFFF;
}
.header{
  background-color:#BE90D4 ;
  color:#FFFFFF;
}
.header-title{
background-color:#9B59B6 ;
color:#FFFFFF;
}
h5{
  color: #FFFFFF;
}
</style>
<?php $form = ActiveForm::begin([
  //  'action' => ['department'],
  'method' => 'post',
]); ?>
<div class="row">
  <div class="col-md-3">
    <?= $form->field($model, 'date1')->widget(DatePicker::ClassName(),
    [
      'name' => 'check_issue_date',
      'options' => ['placeholder' => '-- เลือกวันที่ --'],
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
      'options' => ['placeholder' => '-- เลือกวันที่ --'],
      'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
      ]
    ]);?>
  </div>

  <div class="col-md-2">
    <div class="form-group" style="padding-top:25px;">
      <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-info  glyphicon glyphicon-search']) ?>
      <!-- <a class=" glyphicon glyphicon-print btn btn-normal" href="#" >พิมพ์</a> -->
      <button onclick="printContent('data')" class="glyphicon glyphicon-print btn btn-normal">พิมพ์</button>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>

<?php if ($model->date1 ==  null): ?>
  <?php echo $this->render( '@frontend/modules/rm/views/off'); ?>
<?php else: ?>
<?php $row = 12; ?>
<div id="data" style="background-color:#FFFFFF;">
  <table style="width:100%">
    <tr>
      <td style="33.3%" valign="top">
        <table style="width:100%" class="table table-bordered  table-striped">
          <tr>
            <td colspan="10" align="center" class="header">ความคลาดเคลื่อนจากการสั่งยา</td>
            <?php
            $prescriptionerror_a = 0;
            $prescriptionerror_b = 0;
            $prescriptionerror_c = 0;
            $prescriptionerror_d = 0;
            $prescriptionerror_e = 0;
            $prescriptionerror_f = 0;
            $prescriptionerror_g = 0;
            $prescriptionerror_h = 0;
            $prescriptionerror_i = 0;
            ?>
          </tr>
          <tr>
            <td width="135" rowspan="2" align="center">รายการ</td>
            <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
          </tr>
          <tr>
            <?php  foreach ($level as $levels): ?>
              <td width="17" align="center" style=" color:#FFFFFF;background-color:<?=$levels->color?>;">
                <?=$levels->id ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <?php foreach ($prescriptionerror as $data): ?>
            <tr>
              <td><?= $data->name; ?></td>
              <!-- #### -->
              <td width="17" align="center">
                <?php $A =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'A'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                if ($A>0) {
                  echo "<span style='color:#CF000F ;'>".$A."</span>";
                }

                $prescriptionerror_a =$prescriptionerror_a+$A;
                ?>
              </td>
              <td width="17" align="center">
                <?php $B =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'B'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                if ($B>0) {
                  echo "<span style='color:#CF000F ;'>".$B."</span>";
                }

                $prescriptionerror_b =$prescriptionerror_b+$B;
                ?>
              </td>
              <td width="17" align="center">
                <?php $C =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'C'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                if ($C>0) {
                  echo "<span style='color:#CF000F ;'>".$C."</span>";
                }

                $prescriptionerror_c =$prescriptionerror_c+$C;
                ?>
              </td>
              <td width="17" align="center">
                <?php $D =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'D'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                if ($D>0) {
                  echo "<span style='color:#CF000F ;'>".$D."</span>";
                }

                $prescriptionerror_d =$prescriptionerror_d+$D;
                ?>
              </td>
              <td width="17" align="center">
                <?php $E =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'E'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                  if ($E>0) {
                    echo "<span style='color:#CF000F ;'>".$E."</span>";
                  }

                $prescriptionerror_e =$prescriptionerror_e+$E;
                ?>
              </td>
              <td width="17" align="center">
                <?php $F =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'F'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'administration_error', $data->id])
                ->count();
                if ($F>0) {
                  echo "<span style='color:#CF000F ;'>".$F."</span>";
                }

                $prescriptionerror_f =$prescriptionerror_f+$F;
                ?>
              </td>
              <td width="17" align="center">
                <?php $G =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'G'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                if ($G>0) {
                  echo "<span style='color:#CF000F ;'>".$G."</span>";
                }

                $prescriptionerror_g =$prescriptionerror_g+$G;
                ?>
              </td>
              <td width="17" align="center">
                <?php $H =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'H'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                if ($H>0) {
                  echo "<span style='color:#CF000F ;'>".$H."</span>";
                }

                $prescriptionerror_h =$prescriptionerror_h+$H;
                ?>
              </td>
              <td width="17" align="center">
                <?php $I =  RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>'I'])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['like', 'prescription_error', $data->id])
                ->count();
                if ($I>0) {
                  echo "<span style='color:#CF000F ;'>".$I."</span>";
                }

                $prescriptionerror_I =$prescriptionerror_i+$I;
                ?>
              </td>
              <!-- ####### -->
            </tr>
          <?php endforeach; ?>
          <?php for ($i=0; $i < $row - $prescriptionerrorCount; $i++) : ?>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          <?php endfor; ?>
          <tr>
            <td align="center" class="sum" style="">รวม</td>
            <td class="sum">  <?php echo $prescriptionerror_a; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_b; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_c; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_d; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_e; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_f; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_g; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_h; ?></td>
            <td class="sum">  <?php echo $prescriptionerror_i; ?></td>


          </tr>
          <tr style="background-color:#9B59B6; color:#FFFFFF;">
            <td align="center">รวมทั้งหมด</td>
            <td colspan="9" align="center" >
              <?=
              $prescriptionerror_a+
              $prescriptionerror_b+
              $prescriptionerror_c+
              $prescriptionerror_d+
              $prescriptionerror_e+
              $prescriptionerror_f+
              $prescriptionerror_g+
              $prescriptionerror_h+
              $prescriptionerror_i;

              ?>
            </td>
          </tr>
          <tr>
            <td align="center" class="sum">อัดตรา :
              <?= RmEvent::find()
              ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
              ->andWhere(['rm_level_id' =>['A','B','C','D','E','F','G','H','I']])
              ->andWhere(['rm_type_id' => 'RM03'])
              ->andWhere(['NOT like', 'prescription_error', 'NULL'])
              ->count();
              ?>
              ใบสั่งยา</td>
              <td colspan="9" align="center" class="sum"></td>
            </tr>
          </table>
        </td>
        <td style="33.3%" valign="top">
          <table style="width:100%" class="table table-bordered  table-striped">
            <tr>
              <td colspan="10" align="center" class="header">ความคลาดเคลื่อนจากการสคัดลอกคำสั่ง</td>
              <?php
              $transcribingerror_a = 0;
              $transcribingerror_b = 0;
              $transcribingerror_c = 0;
              $transcribingerror_d = 0;
              $transcribingerror_e = 0;
              $transcribingerror_f = 0;
              $transcribingerror_g = 0;
              $transcribingerror_h = 0;
              $transcribingerror_i = 0;
              ?>
            </tr>
            <tr>
              <td width="135" rowspan="2" align="center">รายการ</td>
              <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
            </tr>
            <tr>
              <?php foreach ($level as $levels): ?>
                <td width="17" align="center" style=" color:#FFFFFF;background-color:<?=$levels->color?>;">
                  <?=$levels->id ?>
                </td>
              <?php endforeach; ?>
            </tr>
            <?php foreach ($transcribingerror as $data): ?>
              <tr>
                <td><?= $data->name; ?></td>
                <!-- #### -->
                <!-- นับจำนวนความเสี่ยง -->

                <td width="17" align="center">
                  <?php $A =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'A'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($A>0) {
                    echo "<span style='color:#CF000F ;'>".$A."</span>";
                  }

                  $transcribingerror_a =$transcribingerror_a+$A;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $B =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'B'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($B>0) {
                    echo "<span style='color:#CF000F ;'>".$B."</span>";
                  }
                  $transcribingerror_b =$transcribingerror_b+$B;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $C =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'C'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($C>0) {
                    echo "<span style='color:#CF000F ;'>".$C."</span>";
                  }
                  $transcribingerror_c =$transcribingerror_c+$C;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $D =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'D'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($D>0) {
                    echo "<span style='color:#CF000F ;'>".$D."</span>";
                  }
                  $transcribingerror_d =$transcribingerror_d+$D;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $E =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'E'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($E>0) {
                    echo "<span style='color:#CF000F ;'>".$E."</span>";
                  }
                  $transcribingerror_e =$transcribingerror_e+$E;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $F =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'F'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($F>0) {
                    echo "<span style='color:#CF000F ;'>".$F."</span>";
                  }
                  $transcribingerror_f =$transcribingerror_f+$F;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $G =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'G'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($G>0) {
                    echo "<span style='color:#CF000F ;'>".$G."</span>";
                  }
                  $transcribingerror_g =$transcribingerror_g+$G;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $H =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'H'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($H>0) {
                    echo "<span style='color:#CF000F ;'>".$H."</span>";
                  }
                  $transcribingerror_h =$transcribingerror_h+$H;
                  ?>
                </td>
                <td width="17" align="center">
                  <?php $I =  RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>'I'])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['like', 'prescription_error', $data->id])
                  ->count();
                  if ($I>0) {
                    echo "<span style='color:#CF000F ;'>".$I."</span>";
                  }
                  $transcribingerror_I =$transcribingerror_i+$I;
                  ?>
                </td>
                <!-- ####### -->
              </tr>
            <?php endforeach; ?>
            <?php for ($i=0; $i < $row - $transcribingerrorCount; $i++) : ?>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            <?php endfor; ?>
            <tr>
              <td align="center" class="sum">รวม</td>
              <td class="sum">  <?php echo $transcribingerror_a; ?></td>
              <td class="sum">  <?php echo $transcribingerror_b; ?></td>
              <td class="sum">  <?php echo $transcribingerror_c; ?></td>
              <td class="sum">  <?php echo $transcribingerror_d; ?></td>
              <td class="sum">  <?php echo $transcribingerror_e; ?></td>
              <td class="sum">  <?php echo $transcribingerror_f; ?></td>
              <td class="sum">  <?php echo $transcribingerror_g; ?></td>
              <td class="sum">  <?php echo $transcribingerror_h; ?></td>
              <td class="sum">  <?php echo $transcribingerror_i; ?></td>


            </tr>
            <tr style="background-color:#9B59B6; color:#FFFFFF;">
              <td align="center">รวมทั้งหมด</td>
              <td colspan="9" align="center">
                <?=
                $transcribingerror_a+
                $transcribingerror_b+
                $transcribingerror_c+
                $transcribingerror_d+
                $transcribingerror_e+
                $transcribingerror_f+
                $transcribingerror_g+
                $transcribingerror_h+
                $transcribingerror_i
                ?>
              </td>
            </tr>
            <tr>
              <td align="center" class="sum">อัดตรา :
                <?= RmEvent::find()
                ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                ->andWhere(['rm_level_id' =>['A','B','C','D','E','F','G','H','I']])
                ->andWhere(['rm_type_id' => 'RM03'])
                ->andWhere(['NOT like', 'transcribing_error', 'NULL'])
                ->count();
                ?>
                ใบสั่งยา</td>
                <td colspan="9" align="center" class="sum"></td>
              </tr>
            </table>
          </td>

          <td style="33.3%" valign="top">
            <table style="width:100%" class="table table-bordered  table-striped">
              <tr>
                <td colspan="10" align="center" class="header">ความคลาดเคลื่อนในกระบวนการจัดยาก่อนจ่ายยา</td>
                <?php
                $predispensingerror_a = 0;
                $predispensingerror_b = 0;
                $predispensingerror_c = 0;
                $predispensingerror_d = 0;
                $predispensingerror_e = 0;
                $predispensingerror_f = 0;
                $predispensingerror_g = 0;
                $predispensingerror_h = 0;
                $predispensingerror_i = 0;

                ?>

              </tr>
              <tr>
                <td width="135" rowspan="2" align="center">รายการ</td>
                <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
              </tr>
              <tr>
                <?php foreach ($level as $levels): ?>
                  <td width="17" align="center" style=" color:#FFFFFF;background-color:<?=$levels->color?>;">
                    <?=$levels->id ?></td>
                  <?php endforeach; ?>
                </tr>
                <?php foreach ($preDispensingerror as $data): ?>
                  <tr>
                    <td><?= $data->name; ?></td>

                    <td width="17" align="center">
                      <?php $A =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'A'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($A>0) {
                        echo "<span style='color:#CF000F ;'>".$A."</span>";
                      }
                      $predispensingerror_a =$predispensingerror_a+$A;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $B =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'B'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($B>0) {
                        echo "<span style='color:#CF000F ;'>".$B."</span>";
                      }
                      $predispensingerror_b =$predispensingerror_b+$B;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $C =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'C'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($C>0) {
                        echo "<span style='color:#CF000F ;'>".$C."</span>";
                      }
                      $predispensingerror_c =$predispensingerror_c+$C;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $D =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'D'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($D>0) {
                        echo "<span style='color:#CF000F ;'>".$D."</span>";
                      }
                      $predispensingerror_d =$predispensingerror_d+$D;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $E =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'E'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($E>0) {
                        echo "<span style='color:#CF000F ;'>".$E."</span>";
                      }
                      $predispensingerror_e =$predispensingerror_e+$E;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $F =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'F'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($F>0) {
                        echo "<span style='color:#CF000F ;'>".$F."</span>";
                      }
                      $predispensingerror_f =$predispensingerror_f+$F;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $G =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'G'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($G>0) {
                        echo "<span style='color:#CF000F ;'>".$G."</span>";
                      }
                      $predispensingerror_g =$predispensingerror_g+$G;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $H =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'H'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($H>0) {
                        echo "<span style='color:#CF000F ;'>".$H."</span>";
                      }
                      $predispensingerror_h =$predispensingerror_h+$H;
                      ?>
                    </td>
                    <td width="17" align="center">
                      <?php $I =  RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>'I'])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['like', 'pre_dispensing_error', $data->id])
                      ->count();
                      if ($I>0) {
                        echo "<span style='color:#CF000F ;'>".$I."</span>";
                      }
                      $predispensingerror_I =$predispensingerror_i+$I;
                      ?>
                    </td>
                    <!-- ####### -->
                  </tr>
                  <!-- ####### -->
                </tr>
              <?php endforeach; ?>
              <?php for ($i=0; $i < $row - $preDispensingerrorCount; $i++) : ?>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              <?php endfor; ?>
              <tr>
                <td align="center" class="sum">รวม</td>
                <td class="sum">  <?php echo $predispensingerror_a; ?></td>
                <td class="sum">  <?php echo $predispensingerror_b; ?></td>
                <td class="sum">  <?php echo $predispensingerror_c; ?></td>
                <td class="sum">  <?php echo $predispensingerror_d; ?></td>
                <td class="sum">  <?php echo $predispensingerror_e; ?></td>
                <td class="sum">  <?php echo $predispensingerror_f; ?></td>
                <td class="sum">  <?php echo $predispensingerror_g; ?></td>
                <td class="sum">  <?php echo $predispensingerror_h; ?></td>
                <td class="sum">  <?php echo $predispensingerror_i; ?></td>

              </tr>
              <tr style="background-color:#9B59B6; color:#FFFFFF;">
                <td align="center">รวมทั้งหมด</td>
                <td colspan="9" align="center" >
                  <?=
                  $predispensingerror_a+
                  $predispensingerror_b+
                  $predispensingerror_c+
                  $predispensingerror_d+
                  $predispensingerror_e+
                  $predispensingerror_f+
                  $predispensingerror_g+
                  $predispensingerror_h+
                  $predispensingerror_i

                  ?>
                </td>
              </tr>
              <tr>
                <td align="center" class="sum">อัดตรา :
                  <?= RmEvent::find()
                  ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                  ->andWhere(['rm_level_id' =>['A','B','C','D','E','F','G','H','I']])
                  ->andWhere(['rm_type_id' => 'RM03'])
                  ->andWhere(['NOT like', 'pre_dispensing_error', 'NULL'])
                  ->count();
                  ?>
                  ใบสั่งยา</td>
                  <td colspan="9" align="center" class="sum"></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <!-- หน้าที่ 2  -->
        <table style="width:100%">
          <tr>
            <td style="33.3%" valign="top">
              <table style="width:100%" class="table table-bordered  table-striped">
                <tr>
                  <td colspan="10" align="center" class="header">
                    ความคลาดเคลื่อนจากการจ่ายยา
                  </td>
                </tr>
                <tr>
                  <td width="135" rowspan="2" align="center">รายการ</td>
                  <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                </tr>
                <tr>
                  <?php
                  $dispensingerror_a = 0;
                  $dispensingerror_b = 0;
                  $dispensingerror_c = 0;
                  $dispensingerror_d = 0;
                  $dispensingerror_e = 0;
                  $dispensingerror_f = 0;
                  $dispensingerror_g = 0;
                  $dispensingerror_h = 0;
                  $dispensingerror_i = 0;
                  ?>
                  <?php foreach ($level as $levels): ?>

                    <td width="17" align="center" style=" color:#FFFFFF;background-color:<?=$levels->color?>;">
                      <?=$levels->id ?></td>
                    <?php endforeach; ?>
                  </tr>
                  <?php foreach ($dispensingerror as $data): ?>
                    <tr>
                      <td><?= $data->name; ?></td>
                      <!-- #### -->
                      <!-- นับจำนวนความเสี่ยง -->

                      <td width="17" align="center">
                        <?php $A =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'A'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($A>0) {
                          echo "<span style='color:#CF000F ;'>".$A."</span>";
                        }
                        $dispensingerror_a = $dispensingerror_a+$A;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $B =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'B'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($B>0) {
                          echo "<span style='color:#CF000F ;'>".$B."</span>";
                        }
                        $dispensingerror_b = $dispensingerror_b+$B;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $C =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'C'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($C>0) {
                          echo "<span style='color:#CF000F ;'>".$C."</span>";
                        }
                        $dispensingerror_c = $dispensingerror_c+$C;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $D =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'D'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($D>0) {
                          echo "<span style='color:#CF000F ;'>".$D."</span>";
                        }
                        $dispensingerror_d = $dispensingerror_c+$D;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $E =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'E'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($E>0) {
                          echo "<span style='color:#CF000F ;'>".$E."</span>";
                        }
                        $dispensingerror_e = $dispensingerror_e+$E;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $F =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'F'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($F>0) {
                          echo "<span style='color:#CF000F ;'>".$F."</span>";
                        }
                        $dispensingerror_f = $dispensingerror_f+$F;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $G =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'G'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($G>0) {
                          echo "<span style='color:#CF000F ;'>".$G."</span>";
                        }
                        $dispensingerror_g = $dispensingerror_g+$G;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $H =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'H'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($H>0) {
                          echo "<span style='color:#CF000F ;'>".$H."</span>";
                        }
                        $dispensingerror_h = $dispensingerror_h+$H;
                        ?>
                      </td>
                      <td width="17" align="center">
                        <?php $I =  RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>'I'])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'dispensing_error', $data->id])
                        ->count();
                        if ($I>0) {
                          echo "<span style='color:#CF000F ;'>".$I."</span>";
                        }
                        $dispensingerror_i = $dispensingerror_i+$I;
                        ?>
                      </td>


                      <!-- ####### -->
                    </tr>
                  <?php endforeach; ?>
                  <?php for ($i=0; $i < $row - $dispensingerrorCount; $i++) : ?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  <?php endfor; ?>
                  <tr>
                    <td align="center" class="sum">รวม</td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_a ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_b ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_c ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_d ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_e ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_f ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_g ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_h ?></td>
                    <td width="17" align="center" class="sum"><?php $Dispensingerror_i ?></td>

                  </tr>
                  <tr style="background-color:#9B59B6; color:#FFFFFF;">
                    <td align="center" >รวมทั้งหมด</td>
                    <td colspan="9" align="center">
                      <?=
                      $dispensingerror_a+
                      $dispensingerror_b+
                      $dispensingerror_c+
                      $dispensingerror_d+
                      $dispensingerror_e+
                      $dispensingerror_f+
                      $dispensingerror_g+
                      $dispensingerror_h+
                      $dispensingerror_i
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td align="center" class="sum">อัดตรา :
                      <?= RmEvent::find()
                      ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                      ->andWhere(['rm_level_id' =>['A','B','C','D','E','F','G','H','I']])
                      ->andWhere(['rm_type_id' => 'RM03'])
                      ->andWhere(['NOT like', 'dispensing_error', 'NULL'])
                      ->count();
                      ?>
                      ใบสั่งยา</td>

                      <td colspan="9" align="center" class="sum"></td>
                    </tr>
                  </table>
                </td>
                <!-- Make -->
                <td style="33.3%" valign="top">
                  <table style="width:100%" class="table table-bordered  table-striped">
                    <tr>
                      <td colspan="10" align="center" class="header">ความคลาดเคลื่อนจากการบริหารยา</td>
                      <?php
                      $administrationerrorr_a = 0;
                      $administrationerrorr_b = 0;
                      $administrationerrorr_c = 0;
                      $administrationerrorr_d = 0;
                      $administrationerrorr_e = 0;
                      $administrationerrorr_f = 0;
                      $administrationerrorr_g = 0;
                      $administrationerrorr_h = 0;
                      $administrationerrorr_i = 0;
                      ?>
                    </tr>
                    <tr>
                      <td width="135" rowspan="2" align="center">รายการ</td>
                      <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                    </tr>
                    <tr>
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center" style=" color:#FFFFFF;background-color:<?=$levels->color?>;">
                          <?=$levels->id ?>
                        </td>
                      <?php endforeach; ?>
                    </tr>
                    <?php foreach ($administrationerror as $data): ?>
                      <tr>
                        <td><?= $data->name; ?></td>
                        <!-- #### -->
                        <!-- นับจำนวนความเสี่ยง -->

                        <td width="17" align="center">
                          <?php $A =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'A'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($A>0) {
                            echo "<span style='color:#CF000F ;'>".$A."</span>";
                          }
                          $administrationerrorr_a =$administrationerrorr_a+$A;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $B =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'B'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($B>0) {
                            echo "<span style='color:#CF000F ;'>".$B."</span>";
                          }
                          $administrationerrorr_b =$administrationerrorr_b+$B;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $C =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'C'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($C>0) {
                            echo "<span style='color:#CF000F ;'>".$C."</span>";
                          }
                          $administrationerrorr_c =$administrationerrorr_c+$C;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $D =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'D'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($D>0) {
                            echo "<span style='color:#CF000F ;'>".$D."</span>";
                          }
                          $administrationerrorr_d =$administrationerrorr_d+$D;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $E =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'E'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($E>0) {
                            echo "<span style='color:#CF000F ;'>".$E."</span>";
                          }
                          $administrationerrorr_e =$administrationerrorr_e+$E;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $F =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'F'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($F>0) {
                            echo "<span style='color:#CF000F ;'>".$F."</span>";
                          }
                          $administrationerrorr_f =$administrationerrorr_f+$F;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $G =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'G'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($G>0) {
                            echo "<span style='color:#CF000F ;'>".$G."</span>";
                          }
                          $administrationerrorr_g =$administrationerrorr_g+$G;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $H =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'H'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($H>0) {
                            echo "<span style='color:#CF000F ;'>".$H."</span>";
                          }
                          $administrationerrorr_h =$administrationerrorr_h+$H;
                          ?>
                        </td>
                        <td width="17" align="center">
                          <?php $I =  RmEvent::find()
                          ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                          ->andWhere(['rm_level_id' =>'I'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $data->id])
                          ->count();
                          if ($I>0) {
                            echo "<span style='color:#CF000F ;'>".$I."</span>";
                          }
                          $administrationerrorr_I =$administrationerrorr_i+$I;
                          ?>
                        </td>
                        <!-- ####### -->
                      </tr>
                    <?php endforeach; ?>
                    <?php for ($i=0; $i < $row - $administrationerrorCount; $i++) : ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    <?php endfor; ?>
                    <tr>
                      <td align="center" class="sum">รวม</td>
                      <td class="sum">  <?php echo $administrationerrorr_a; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_b; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_c; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_d; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_e; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_f; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_g; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_h; ?></td>
                      <td class="sum">  <?php echo $administrationerrorr_i; ?></td>


                    </tr>
                    <tr style="background-color:#9B59B6; color:#FFFFFF;">
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center">
                        <?=
                        $administrationerrorr_a+
                        $administrationerrorr_b+
                        $administrationerrorr_c+
                        $administrationerrorr_d+
                        $administrationerrorr_e+
                        $administrationerrorr_f+
                        $administrationerrorr_g+
                        $administrationerrorr_h+
                        $administrationerrorr_i
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" class="sum">อัดตรา :
                        <?= RmEvent::find()
                        ->where(['between', 'event_date', $model->date1 ,$model->date2 ])
                        ->andWhere(['rm_level_id' =>['A','B','C','D','E','F','G','H','I']])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['NOT like', 'administration_error', 'NULL'])
                        ->count();
                        ?>
                        ใบสั่งยา</td>


                        <td colspan="9" align="center" class="sum"></td>
                      </tr>
                    </table>
                  </td>
                  <td style="33.3%" valign="top">

                    <table style="width:100%" class="table table-bordered  table-striped">
                      <tr>
                        <td colspan="10" align="center" class="header">การแพ้ยา</td>
                      </tr>
                      <tr>
                        <td width="135" rowspan="2" align="center">รายการ</td>
                        <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                      </tr>
                      <tr>
                        <td width="17" align="center">A</td>
                        <td width="16" align="center">B</td>
                        <td width="17" align="center">C</td>
                        <td width="17" align="center">D</td>
                        <td width="14" align="center">E</td>
                        <td width="14" align="center">F</td>
                        <td width="17" align="center">G</td>
                        <td width="17" align="center">H</td>
                        <td width="8" align="center">I</td>
                      </tr>
                    
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" class="sum">รวม</td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                      </tr>
                      <tr style="background-color:#9B59B6; color:#FFFFFF;">
                        <td align="center">รวมทั้งหมด</td>
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
                      <tr>
                        <td colspan="10" align="center" class="header">การแพ้ยาซ้ำ</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>

                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" class="sum">รวม</td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                      </tr>
                      <tr style="background-color:#9B59B6; color:#FFFFFF;">
                        <td align="center">รวมทั้งหมด</td>
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
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>

                      <tr>
                        <td colspan="10" align="center" class="header">ความคลาดเคลื่อนทางยาอื่นๆ</td>
                      </tr>

                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" class="sum">รวม</td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                        <td class="sum"></td>
                      </tr>
                      <tr style="background-color:#9B59B6; color:#FFFFFF;">
                        <td align="center">รวมทั้งหมด</td>
                        <td colspan="9" align="center" ></td>
                      </tr>
                      <tr>
                        <td align="center" class="sum">อัดตรา : 1000 ใบสั่งยา</td>
                        <td colspan="9" align="center" class="sum"></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
          <?php endif ?>

<?php
$js = <<< JS

JS;
$this->registerJs($js);
?>

<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
