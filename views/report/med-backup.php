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
     background-color:#BDC3C7;
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

    <div class="col-md-2">
    	<div class="form-group" style="padding-top:25px;">
        <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-info  glyphicon glyphicon-search']) ?>
        <a class=" glyphicon glyphicon-print btn btn-normal" href="#" >พิมพ์</a>
    </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>

            <?php if ($model->date1 ==  null): ?>
            <?php echo $this->render( '@frontend/modules/rm/views/off'); ?>
            <?php else: ?>
              <div class="panel panel-primary">
                  <div class="panel-heading"><i class="glyphicon glyphicon-cog" ></i>&nbsp;
                    สถานะการทำงาน
                  </div>
                  <div class="panel-body" >
              <?php
              $sum_a = 0;
              $sum_b = 0;
              $sum_c = 0;
              $sum_d = 0;
              $sum_e = 0;
              $sum_f = 0;
              $sum_g = 0;
              $sum_h = 0;
              $sum_i = 0;
               ?>
                <?php $row = 26; ?>
              <table style="width:100%">
                <tr>
                  <td style="33.3%" valign="top">
                    <table style="width:100%" border="1">
                    <tr>
                      <td colspan="10" align="center" style="background-color:#22A7F0;color:#FFFFFF;">ความคลาดเคลื่อนจากการจ่ายยา</td>
                      </tr>
                    <tr>
                      <td width="135" rowspan="2" align="center">รายการ</td>
                      <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                      </tr>
                      <tr>
                        <?php foreach ($level as $levels): ?>
                          <td width="17" align="center"><?=$levels->id ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <?php foreach ($dispensingerror as $model): ?>
                    <tr>
                      <td><?=$model->name; ?></td>
                      <!-- #### -->
                      <!-- นับจำนวนความเสี่ยง -->

                        <td width="17" align="center">
                          <?php
                         $A =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'A'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            if ($A > 0) {
                              echo $a = $A;
                            }
                            $sum_a = $sum_a+$a;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $B =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'B'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          if ($B > 0) {
                            echo $b = $B;
                          }
                          $sum_b = $sum_b+$b;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $C =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'C'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            echo $c = $C;
                            $sum_c = $sum_c+$c;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $D =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'D'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            echo $d = $D;$sum_d = $sum_c+$d;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $E =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'E'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            echo $e = $E;$sum_e = $sum_e+$e;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $F =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'F'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            echo $f = $F;$sum_f = $sum_f+$f;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $G =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'G'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            echo $g = $G;$sum_g = $sum_g+$g;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $H =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'H'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            echo $h = $H;$sum_h = $sum_h+$h;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?php
                         $I =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'I'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            echo $i = $I;$sum_i = $sum_i+$i;
                           ?>
                        </td>


                      <!-- ####### -->
                    </tr>
                    <?php endforeach; ?>
                    <?php for ($i=0; $i < $row - $dispensingerrorCount; $i++) : ?>
                    <tr>
                      <td></td>
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
                        <td width="17" align="center" class="sum"><?=$sum_a ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_b ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_c ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_d ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_e ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_f ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_g ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_h ?></td>
                        <td width="17" align="center" class="sum"><?=$sum_i ?></td>

                    </tr>
                    <tr>
                      <td align="center" >รวมทั้งหมด</td>
                      <td colspan="9" align="center">100&nbsp;</td>
                      </tr>
                    <tr>
                      <td align="center" class="sum">อัดตรา :
                        <?php
                        $sql = 'SELECT id FROM rm_event
                                WHERE event_date BETWEEN "2015-01-01" AND "2016-12-30"
                                AND dispensing_error NOT like CONCAT("%NULL%")
                                AND rm_type_id = "RM03"';
                                $query  = Yii::$app->db->createCommand($sql)->queryAll();
                           echo   count($query);
                         ?>
                         ใบสั่งยา</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                      </tr>
                  </table>
                </td>
                <td style="33.3%" valign="top">
                  <table style="width:100%" border="1">
                    <tr>
                      <td colspan="10" align="center">ความคลาดเคลื่อนจากการบริหารยา</td>
                      </tr>
                    <tr>
                      <td width="135" rowspan="2" align="center">รายการ</td>
                      <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                      </tr>
                    <tr>
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center">
                          <?=$levels->id ?>
                        </td>
                      <?php endforeach; ?>
                      </tr>
                      <?php foreach ($administrationerror as $model): ?>
                    <tr>
                      <td><?=$model->name; ?></td>
                      <!-- #### -->
                      <!-- นับจำนวนความเสี่ยง -->
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center">
                          <?php
                          $value = RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' => $levels->id])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                          if($value > 0){echo $value;}
                           ?>
                        </td>
                      <?php endforeach; ?>
                      <!-- ####### -->
                    </tr>
                    <?php endforeach; ?>
                    <?php for ($i=0; $i < $row - $administrationerrorCount; $i++) : ?>
                    <tr>
                      <td></td>
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
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>

                    </tr>
                    <tr>
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                      </tr>
                    <tr>
                      <td align="center" class="sum">อัดตรา :
                        <?php
                        $sql = 'SELECT id FROM rm_event
                                WHERE event_date BETWEEN "2015-01-01" AND "2016-12-30"
                                AND administration_error NOT like CONCAT("%NULL%")
                                AND rm_type_id = "RM03"';
                                $query  = Yii::$app->db->createCommand($sql)->queryAll();
                           echo   count($query);
                         ?>
                         ใบสั่งยา</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                      </tr>
                  </table>
                </td>
                <td style="33.3%" valign="top">
                  <table style="width:100%" border="1">
                    <tr>
                      <td colspan="10" align="center">ความคลาดเคลื่อนในกระบวนการจัดยาก่อนจ่ายยา</td>
                    </tr>
                    <tr>
                      <td width="135" rowspan="2" align="center">รายการ</td>
                      <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                    </tr>
                    <tr>
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center"><?=$levels->id ?></td>
                      <?php endforeach; ?>
                    </tr>
                    <?php foreach ($preDispensingerror as $model): ?>
                  <tr>
                    <td><?=$model->name; ?></td>
                    <!-- #### -->
                    <!-- นับจำนวนความเสี่ยง -->
                    <?php foreach ($level as $levels): ?>
                      <td width="17" align="center">
                        <?php
                        $value = RmEvent::find()
                        ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                        ->andWhere(['rm_level_id' => $levels->id])
                        ->andWhere(['rm_type_id' => 'RM03'])
                        ->andWhere(['like', 'pre_dispensing_error', $model->id])
                        ->count();
                        if($value > 0){echo $value;}
                         ?>
                      </td>
                    <?php endforeach; ?>
                    <!-- ####### -->
                  </tr>
                  <?php endforeach; ?>
                  <?php for ($i=0; $i < $row - $preDispensingerrorCount; $i++) : ?>
                  <tr>
                    <td></td>
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
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                      <td class="sum">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" class="sum">อัดตรา :
                        <?php
                        $sql = 'SELECT id FROM rm_event
                                WHERE event_date BETWEEN "2015-01-01" AND "2016-12-30"
                                AND pre_dispensing_error NOT like CONCAT("%NULL%")
                                AND rm_type_id = "RM03"';
                                $query  = Yii::$app->db->createCommand($sql)->queryAll();
                           echo   count($query);
                         ?>
                         ใบสั่งยา</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                    </tr>
                  </table>
                </td>
                </tr>
              </table>
              <!-- หน้าที่ 2  -->
              <table style="width:100%">
                <tr>
                  <td style="33.3%" valign="top">
                    <table style="width:100%" border="1">
                    <tr>
                      <td colspan="10" align="center">ความคลาดเคลื่อนจากการจ่ายยา</td>
                      </tr>
                    <tr>
                      <td width="135" rowspan="2" align="center">รายการ</td>
                      <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                      </tr>
                      <tr>
                        <?php foreach ($level as $levels): ?>
                          <td width="17" align="center"><?=$levels->id ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <?php foreach ($dispensingerror as $model): ?>
                    <tr>
                      <td><?=$model->name; ?></td>
                      <!-- #### -->
                      <!-- นับจำนวนความเสี่ยง -->
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center">
                          <?php
                         $value =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' => $levels->id])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          if($value > 0){echo $value;}

                          $sum = $sum=$value;
                           ?>
                        </td>
                      <?php endforeach; ?>
                      <!-- ####### -->
                    </tr>
                    <?php endforeach; ?>
                    <?php for ($i=0; $i < $row - $dispensingerrorCount; $i++) : ?>
                    <tr>
                      <td></td>
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
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center"><?=$levels->id ?></td>
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center">100&nbsp;</td>
                      </tr>
                    <tr>
                      <td align="center" class="sum">อัดตรา :
                        <?php
                        $sql = 'SELECT id FROM rm_event
                                WHERE event_date BETWEEN "2015-01-01" AND "2016-12-30"
                                AND dispensing_error NOT like CONCAT("%NULL%")
                                AND rm_type_id = "RM03"';
                                $query  = Yii::$app->db->createCommand($sql)->queryAll();
                           echo   count($query);
                         ?>
                         ใบสั่งยา</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                      </tr>
                  </table>
                </td>
                <td style="33.3%" valign="top">
                  <table style="width:100%" border="1">
                    <tr>
                      <td colspan="10" align="center">ความคลาดเคลื่อนจากการบริหารยา</td>
                      </tr>
                    <tr>
                      <td width="135" rowspan="2" align="center">รายการ</td>
                      <td colspan="9" align="center">จำนวนครั้ง/ระดับความรุนแรง</td>
                      </tr>
                    <tr>
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center">
                          <?=$levels->id ?>
                        </td>
                      <?php endforeach; ?>
                      </tr>
                      <?php foreach ($administrationerror as $model): ?>
                    <tr>
                      <td><?=$model->name; ?></td>
                      <!-- #### -->
                      <!-- นับจำนวนความเสี่ยง -->
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center">
                          <?php
                          $value = RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' => $levels->id])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                          if($value > 0){echo $value;}
                           ?>
                        </td>
                      <?php endforeach; ?>
                      <!-- ####### -->
                    </tr>
                    <?php endforeach; ?>
                    <?php for ($i=0; $i < $row - $administrationerrorCount; $i++) : ?>
                    <tr>
                      <td></td>
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
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    <td class="sum">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                      </tr>
                    <tr>
                      <td align="center" class="sum">อัดตรา :
                        <?php
                        $sql = 'SELECT id FROM rm_event
                                WHERE event_date BETWEEN "2015-01-01" AND "2016-12-30"
                                AND administration_error NOT like CONCAT("%NULL%")
                                AND rm_type_id = "RM03"';
                                $query  = Yii::$app->db->createCommand($sql)->queryAll();
                           echo   count($query);
                         ?>
                         ใบสั่งยา</td>
                      <td colspan="9" align="center" class="sum">&nbsp;</td>
                      </tr>
                  </table>
                </td>
                <td style="33.3%" valign="top">

                  <table style="width:100%" border="1">
      <tr>
        <td colspan="10" align="center">การแพ้ยา</td>
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
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">รวมทั้งหมด</td>
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
        <td colspan="10" align="center">การแพ้ยาซ้ำ</td>
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
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      <td class="sum">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">รวมทั้งหมด</td>
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
        <td colspan="10" align="center">ความคลาดเคลื่อนทางยาอื่นๆ</td>
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
        <td>EE</td>
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
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
        <td class="sum">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">รวมทั้งหมด</td>
        <td colspan="9" align="center" class="sum">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="sum">อัดตรา : 1000 ใบสั่งยา</td>
        <td colspan="9" align="center" class="sum">&nbsp;</td>
      </tr>
    </table>



                </td>
                </tr>
              </table>


</div>
</div>
            <?php endif ?>
