
<?php
use risk\models\RmEvent;
$sum=0;
 ?>
  <?php $row = 26; ?>
<table width="1013" border="0">
  <tr>
    <td width="1007" align="center">แบบรายงานความคลาดเคลื่อนทางยา ผู้ป่วยนอก</td>
  </tr>
  <tr>
    <td align="center">ฝ่ายเภสัชกรรม  โรงพยาบาลโนนสัง   จังหวัดหนองบัวลำภู</td>
  </tr>
  <tr>
    <td align="center">ประจำวันที่ ...... เดือน.............พ.ศ...........</td>
  </tr>
</table>

                <?php $row = 26; ?>
              <table style="width:100%">
                <tr>
                  <td style="33.3%" valign="top">
                  <table style="width:100%" border="1">
                    <tr>
                      <td colspan="10" align="center">ความคลาดเคลื่อนจากการสั่งยา</td>
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
                      <?php foreach ($level as $levels): ?>
                        <td width="17" align="center">
                          <?=$levels->id ?>
                        </td>
                      <?php endforeach; ?>
                      </tr>
                      <?php foreach ($prescriptionerror as $model): ?>
                    <tr>
                      <td><?=$model->name; ?></td>
                      <!-- #### -->
                      <!-- นับจำนวนความเสี่ยง -->

                        <td width="17" align="center">
                          <?=$A =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'A'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_a =$prescriptionerror_a+$A;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$B =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'B'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_b =$prescriptionerror_b+$B;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$C =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'C'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_c =$prescriptionerror_c+$C;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$D =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'D'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_d =$prescriptionerror_d+$D;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$E =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'E'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_e =$prescriptionerror_e+$E;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$F =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'F'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $prescriptionerror_f =$prescriptionerror_f+$F;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$G =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'G'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_g =$prescriptionerror_g+$G;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$H =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'H'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_h =$prescriptionerror_h+$H;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$I =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'I'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'prescription_error', $model->id])
                          ->count();
                            $prescriptionerror_I =$prescriptionerror_i+$I;
                           ?>
                        </td>
                      <!-- ####### -->
                    </tr>
                    <?php endforeach; ?>
                    <?php for ($i=0; $i < $row - $prescriptionerrorCount; $i++) : ?>
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
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_a; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_b; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_c; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_d; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_e; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_f; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_g; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_h; ?></td>
                      <td class="sum">&nbsp;  <?php echo $prescriptionerror_i; ?></td>


                    </tr>
                    <tr>
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center" >&nbsp;</td>
                      </tr>
                    <tr>
                      <td align="center" class="sum">อัดตรา :
                        <?php
                        $sql = 'SELECT id FROM rm_event
                                WHERE event_date BETWEEN "2015-01-01" AND "2016-12-30"
                                AND prescription_error NOT like CONCAT("%NULL%")
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
                                      <td colspan="10" align="center">ความคลาดเคลื่อนจากการสคัดลอกคำสั่ง</td>
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
                                        <td width="17" align="center">
                                          <?=$levels->id ?>
                                        </td>
                                      <?php endforeach; ?>
                                      </tr>
                                      <?php foreach ($transcribingerror as $model): ?>
                                    <tr>
                                      <td><?=$model->name; ?></td>
                                      <!-- #### -->
                                      <!-- นับจำนวนความเสี่ยง -->

                                        <td width="17" align="center">
                                          <?=$A =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'A'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_a =$transcribingerror_a+$A;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$B =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'B'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_b =$transcribingerror_b+$B;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$C =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'C'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_c =$transcribingerror_c+$C;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$D =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'D'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_d =$transcribingerror_d+$D;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$E =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'E'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_e =$transcribingerror_e+$E;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$F =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'F'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_f =$transcribingerror_f+$F;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$G =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'G'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_g =$transcribingerror_g+$G;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$H =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'H'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_h =$transcribingerror_h+$H;
                                           ?>
                                        </td>
                                        <td width="17" align="center">
                                          <?=$I =  RmEvent::find()
                                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                                          ->andWhere(['rm_level_id' =>'I'])
                                          ->andWhere(['rm_type_id' => 'RM03'])
                                          ->andWhere(['like', 'prescription_error', $model->id])
                                          ->count();
                                            $transcribingerror_I =$transcribingerror_i+$I;
                                           ?>
                                        </td>
                                      <!-- ####### -->
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php for ($i=0; $i < $row - $transcribingerrorCount; $i++) : ?>
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
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_a; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_b; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_c; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_d; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_e; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_f; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_g; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_h; ?></td>
                                      <td class="sum">&nbsp;  <?php echo $transcribingerror_i; ?></td>


                                    </tr>
                                    <tr>
                                      <td align="center">รวมทั้งหมด</td>
                                      <td colspan="9" align="center">&nbsp;</td>
                                      </tr>
                                    <tr>
                                      <td align="center" class="sum">อัดตรา :
                                        <?php
                                        $sql = 'SELECT id FROM rm_event
                                                WHERE event_date BETWEEN "2015-01-01" AND "2016-12-30"
                                                AND prescription_error NOT like CONCAT("%NULL%")
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
                        <td width="17" align="center"><?=$levels->id ?></td>
                      <?php endforeach; ?>
                    </tr>
                    <?php foreach ($preDispensingerror as $model): ?>
                  <tr>
                    <td><?=$model->name; ?></td>

                          <td width="17" align="center">
                            <?=$A =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'A'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_a =$predispensingerror_a+$A;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$B =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'B'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_b =$predispensingerror_b+$B;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$C =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'C'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_c =$predispensingerror_c+$C;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$D =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'D'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_d =$predispensingerror_d+$D;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$E =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'E'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_e =$predispensingerror_e+$E;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$F =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'F'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_f =$predispensingerror_f+$F;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$G =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'G'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_g =$predispensingerror_g+$G;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$H =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'H'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
                              $predispensingerror_h =$predispensingerror_h+$H;
                             ?>
                          </td>
                          <td width="17" align="center">
                            <?=$I =  RmEvent::find()
                            ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                            ->andWhere(['rm_level_id' =>'I'])
                            ->andWhere(['rm_type_id' => 'RM03'])
                            ->andWhere(['like', 'pre_dispensing_error', $model->id])
                            ->count();
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
                      <td class="sum">&nbsp;  <?php echo $predispensingerror_a; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_b; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_c; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_d; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_e; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_f; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_g; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_h; ?></td>
                  <td class="sum">&nbsp;  <?php echo $predispensingerror_i; ?></td>

                    </tr>
                    <tr>
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center" >&nbsp;</td>
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
                      <td colspan="10" align="center">
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

                          <td width="17" align="center"><?=$levels->id ?></td>
                        <?php endforeach; ?>
                      </tr>
                      <?php foreach ($dispensingerror as $model): ?>
                    <tr>
                      <td><?=$model->name; ?></td>
                      <!-- #### -->
                      <!-- นับจำนวนความเสี่ยง -->

                        <td width="17" align="center">
                          <?=$A =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'A'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            $dispensingerror_a = $dispensingerror_a+$A;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$B =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'B'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          $dispensingerror_b = $dispensingerror_b+$B;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$C =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'C'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            $dispensingerror_c = $dispensingerror_c+$C;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$D =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'D'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          $dispensingerror_d = $dispensingerror_c+$D;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$E =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'E'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          $dispensingerror_e = $dispensingerror_e+$E;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$F =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'F'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          $dispensingerror_f = $dispensingerror_f+$F;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$G =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'G'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                            $dispensingerror_g = $dispensingerror_g+$G;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$H =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'H'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          $dispensingerror_h = $dispensingerror_h+$H;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$I =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'I'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'dispensing_error', $model->id])
                          ->count();
                          $dispensingerror_i = $dispensingerror_i+$I;
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
                        <td width="17" align="center" class="sum"><?=$dispensingerror_a ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_b ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_c ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_d ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_e ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_f ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_g ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_h ?></td>
                        <td width="17" align="center" class="sum"><?=$dispensingerror_i ?></td>

                    </tr>
                    <tr>
                      <td align="center" >รวมทั้งหมด</td>
                      <td colspan="9" align="center">100 &nbsp;</td>
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

                Make
                <td style="33.3%" valign="top">
                  <table style="width:100%" border="1">
                    <tr>
                      <td colspan="10" align="center">ความคลาดเคลื่อนจากการบริหารยา</td>
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

                        <td width="17" align="center">
                          <?=$A =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'A'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_a =$administrationerrorr_a+$A;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$B =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'B'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_b =$administrationerrorr_b+$B;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$C =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'C'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_c =$administrationerrorr_c+$C;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$D =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'D'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_d =$administrationerrorr_d+$D;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$E =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'E'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_e =$administrationerrorr_e+$E;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$F =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'F'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_f =$administrationerrorr_f+$F;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$G =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'G'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_g =$administrationerrorr_g+$G;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$H =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'H'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_h =$administrationerrorr_h+$H;
                           ?>
                        </td>
                        <td width="17" align="center">
                          <?=$I =  RmEvent::find()
                          ->where(['between', 'event_date', "2015-06-21", "2016-12-30" ])
                          ->andWhere(['rm_level_id' =>'I'])
                          ->andWhere(['rm_type_id' => 'RM03'])
                          ->andWhere(['like', 'administration_error', $model->id])
                          ->count();
                            $administrationerrorr_I =$administrationerrorr_i+$I;
                           ?>
                        </td>
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
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_a; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_b; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_c; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_d; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_e; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_f; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_g; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_h; ?></td>
                      <td class="sum">&nbsp;  <?php echo $administrationerrorr_i; ?></td>


                    </tr>
                    <tr>
                      <td align="center">รวมทั้งหมด</td>
                      <td colspan="9" align="center">&nbsp;</td>
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
        <td colspan="9" align="center" >&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="sum">อัดตรา : 1000 ใบสั่งยา</td>
        <td colspan="9" align="center" class="sum">&nbsp;</td>
      </tr>
    </table>



                </td>
                </tr>
              </table>

<!-- หน้าที่ 2  -->
