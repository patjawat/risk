<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_event".
 *
 * @property integer $id
 * @property string $ref
 * @property string $rm_level_id
 * @property string $rm_levelgroup_id
 * @property integer $rm_items_id
 * @property string $rm_group_id
 * @property string $rm_workgroup_id
 * @property string $rm_type_id
 * @property string $rm_type_id1
 * @property integer $rm_reporttype_id
 * @property integer $rm_department_position_id
 * @property string $department_id
 * @property string $accident
 * @property string $urgent
 * @property string $editing
 * @property string $rca_date
 * @property string $review_date
 * @property string $check
 * @property string $check_date
 * @property string $event_date
 * @property string $event_time
 * @property string $report_date
 * @property string $report_time
 * @property string $accident_name
 * @property integer $age
 * @property string $hn
 * @property string $an
 * @property string $rm_event_note
 * @property string $editing_note
 * @property integer $reporter
 * @property string $related
 * @property string $images
 * @property string $review
 * @property string $prescription_error
 * @property string $prescription_laza
 * @property string $prescription_name
 * @property string $prescription_name2
 * @property string $pre_dispensing_error
 * @property string $transcribing_error
 * @property string $transcribing_laza
 * @property string $transcribing_name
 * @property string $administration_error
 * @property string $administration_laza
 * @property string $administration_type
 * @property string $administration_name
 * @property string $dispensing_error
 * @property string $dispensing_laza
 * @property string $dispensing_name
 * @property string $prescription_error_note
 * @property string $pre_dispensing_error_note
 * @property string $transcribing_error_note
 * @property string $administration_error_note
 * @property string $dispensing_error_note
 * @property string $pre_dispensing_laza
 * @property string $pre_dispensing_man
 * @property string $pre_dispensing_check
 * @property string $review_teme
 * @property string $wi
 * @property string $wi_name
 * @property string $sp
 * @property string $sp_name
 * @property string $cpg_cnpg
 * @property string $cpg_cnpg_name
 * @property string $created_at
 *
 * @property RmDepartmentPosition $rmDepartmentPosition
 * @property RmItems $rmItems
 * @property RmLevel $rmLevel
 * @property RmReporttype $rmReporttype
 * @property RmEventHasHow[] $rmEventHasHows
 * @property RmHow[] $hows
 * @property RmEventHasLeveleffect[] $rmEventHasLeveleffects
 * @property RmLevelHasEffect[] $rmLevels
 * @property RmEventHasResult[] $rmEventHasResults
 * @property RmResult[] $rmResults
 */
class RmEvent extends \yii\db\ActiveRecord
{
  public $event_has_effecf;
    public static function tableName()
    {
        return 'rm_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref', 'rm_level_id', 'rm_levelgroup_id', 'rm_items_id', 'rm_group_id', 'rm_workgroup_id', 'rm_type_id', 'rm_reporttype_id', 'rm_department_position_id', 'department_id', 'accident', 'urgent', 'editing'], 'required'],
            [['ref', 'accident', 'urgent', 'editing', 'images', 'review'], 'string'],
            [['rm_items_id', 'rm_reporttype_id', 'rm_department_position_id', 'age', 'reporter'], 'integer'],
            [['rca_date', 'review_date', 'check_date', 'event_date', 'event_time', 'report_date', 'report_time', 'review_teme', 'created_at'], 'safe'],
            [['rm_level_id', 'rm_levelgroup_id'], 'string', 'max' => 1],
            [['rm_group_id', 'rm_workgroup_id', 'prescription_laza', 'transcribing_laza', 'administration_laza', 'dispensing_laza', 'pre_dispensing_laza'], 'string', 'max' => 5],
            [['rm_type_id', 'rm_type_id1'], 'string', 'max' => 10],
            [['department_id'], 'string', 'max' => 50],
            [['check', 'accident_name', 'hn', 'an', 'wi_name'], 'string', 'max' => 45],
            [['rm_event_note', 'editing_note', 'related', 'prescription_error', 'pre_dispensing_error', 'transcribing_error', 'administration_error', 'dispensing_error', 'prescription_error_note', 'pre_dispensing_error_note', 'transcribing_error_note', 'administration_error_note', 'dispensing_error_note', 'wi', 'sp', 'sp_name', 'cpg_cnpg', 'cpg_cnpg_name'], 'string', 'max' => 255],
            [['prescription_name', 'prescription_name2', 'transcribing_name', 'administration_name', 'dispensing_name', 'pre_dispensing_man', 'pre_dispensing_check'], 'string', 'max' => 100],
            [['administration_type'], 'string', 'max' => 4],
            [['rm_department_position_id', 'department_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmDepartmentPosition::className(), 'targetAttribute' => ['rm_department_position_id' => 'id', 'department_id' => 'department_id']],
            [['rm_items_id', 'rm_group_id', 'rm_workgroup_id', 'rm_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmItems::className(), 'targetAttribute' => ['rm_items_id' => 'id', 'rm_group_id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id', 'rm_type_id' => 'rm_type_id']],
            [['rm_level_id', 'rm_levelgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmLevel::className(), 'targetAttribute' => ['rm_level_id' => 'id', 'rm_levelgroup_id' => 'rm_levelgroup_id']],
            [['rm_reporttype_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmReporttype::className(), 'targetAttribute' => ['rm_reporttype_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'Ref',
            'rm_level_id' => 'ระดับความเสี่ยง',
            'rm_levelgroup_id' => 'ระดับความรุนแรง',
            'rm_items_id' => 'ชื่อความเสี่ยง',
            'rm_group_id' => 'โปรแกรมความเสี่ยง',
            'rm_workgroup_id' => 'ทีมคล่อม',
            'rm_type_id' => 'ประเภท',
            'rm_type_id1' => 'ประเภท',
            'rm_reporttype_id' => 'การรายงาน',
            'rm_department_position_id' => 'จุดเกิดเหตุ',
            'department_id' => 'หน่วยงานที่เกิดเหตุ',
            'accident' => 'ผู้รับผลกระทบ',
            'urgent' => 'ความเร่งด่วน',
            'editing' => 'การแก้ไขเบื้องต้น',
            'rca_date' => 'ทำ RCA วันที่',
            'review_date' => 'ส่งผลการทบทวนวันที่',
            'check' => 'การตรวจรับ',
            'check_date' => 'วันที่ตรวจรับ',
            'event_date' => 'วันที่เกิดเหตุ',
            'event_time' => 'เวลา',
            'report_date' => 'วันที่รายงาน',
            'report_time' => 'เวลารายงาน',
            'accident_name' => 'ชื่อผู้ประสบเหตุ',
            'age' => 'อายุ',
            'hn' => 'Hn',
            'an' => 'An',
            'rm_event_note' => 'บรรยายเหตุการณ์โดยย่อ',
            'editing_note' => 'วิธีการแก้ปัญหาดังนี้',
            'reporter' => 'ผู้รายงาน',
            'related' => 'หน่วยงานที่เกดี่ยวข้อง',
            'images' => 'ภาพประกอบ',
            'review' => 'การทบทวน',
            'prescription_error' => 'ความคลาดเคลื่อนในการสั่งใช้ยา (Prescription Error)',
            'prescription_laza' => 'Laza',
            'prescription_name' => 'ผู้จัด',
            'prescription_name2' => 'ผู้ตรวจสอบ',
            'pre_dispensing_error' => 'ความคลาดเคลื่อนในกระบวนการจัดยาก่อนจ่ายยา (Pre-Dispensing Error)',
            'transcribing_error' => 'ความคลาดเคลื่อนในการคัดลอกคำสั่งใช้ยา (Transcribing Error)',
            'transcribing_laza' => 'laza',
            'transcribing_name' => 'ชื่อผู้คัดลอกคำสั่งใช้ยา',
            'administration_error' => 'ความคลาดเคลื่อนในการบริหารยา (Administration Error)',
            'administration_laza' => 'LAZA',
            'administration_type' => 'ประเภท',
            'administration_name' => 'ชื่อ',
            'dispensing_error' => 'ความคลาดเคลื่อนในการจ่ายยา (Dispensing Error)',
            'dispensing_laza' => 'Laza',
            'dispensing_name' => 'ผู้จ่าย',
            'prescription_error_note' => 'หมายเหตุ',
            'pre_dispensing_error_note' => 'หมายเหตุ',
            'transcribing_error_note' => 'หมายเหตุ',
            'administration_error_note' => 'หมายเหตุ',
            'dispensing_error_note' => 'หมายเหตุ',
            'pre_dispensing_laza' => 'Pre Dispensing Laza',
            'pre_dispensing_man' => 'ผู้จัด',
            'pre_dispensing_check' => 'ผู้ตรวจสอบ',
            'review_teme' => 'ทบทวนโดยทีม',
            'wi' => 'คู่มือปฏิบัติงาน',
            'wi_name' => 'ชื่อเรื่อง',
            'sp' => 'ระเบียบปฏิบัติงาน',
            'sp_name' => 'เรื่อง',
            'cpg_cnpg' => 'CPG,CNPG',
            'cpg_cnpg_name' => 'เรื่อง',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmDepartmentPosition()
    {
        return $this->hasOne(RmDepartmentPosition::className(), ['id' => 'rm_department_position_id', 'department_id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmItems()
    {
        return $this->hasOne(RmItems::className(), ['id' => 'rm_items_id', 'rm_group_id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id', 'rm_type_id' => 'rm_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevel()
    {
        return $this->hasOne(RmLevel::className(), ['id' => 'rm_level_id', 'rm_levelgroup_id' => 'rm_levelgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmReporttype()
    {
        return $this->hasOne(RmReporttype::className(), ['id' => 'rm_reporttype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEventHasHows()
    {
        return $this->hasMany(RmEventHasHow::className(), ['rm_event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHows()
    {
        return $this->hasMany(RmHow::className(), ['id' => 'how_id'])->viaTable('rm_event_has_how', ['rm_event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEventHasLeveleffects()
    {
        return $this->hasMany(RmEventHasLeveleffect::className(), ['rm_event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevels()
    {
        return $this->hasMany(RmLevelHasEffect::className(), ['rm_level_id' => 'rm_level_id', 'rm_effect_id' => 'rm_effect_id'])->viaTable('rm_event_has_leveleffect', ['rm_event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEventHasResults()
    {
        return $this->hasMany(RmEventHasResult::className(), ['rm_event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmResults()
    {
        return $this->hasMany(RmResult::className(), ['id' => 'rm_result_id'])->viaTable('rm_event_has_result', ['rm_event_id' => 'id']);
    }

    public function DateTo($date){
         $get_date = explode("/","$date"); //แยกวันที่
         $date_time = explode(" เวลา ","$date"); //แยกวเวลา
         $d =$get_date["0"]; //วัน0
         $m = $get_date["1"]; //เดื0อน
         $y = $get_date["2"]; // ปี
         $y1 = $y-543;
         $time = substr($date_time['1'],0,6);
         return   $y1.'-'.$m.'-'.$d.' '.$time.':'.'00'; //ส่งค่าวันที่กับเวลากลับ
         // $time = substr($date_time['1'],0,-3);

           // $y1.'-'.$m.'-'.$d; //ส่งค่าวันที่กลับ
       }
       public function DateFrom($date){
         $get_date = explode("-","$date"); //แยกวันที่
         $date_time = explode(" ","$date"); //แยกวเวลา
         $get_date["2"];
         //echo substr($get_date["2"],0,2);
         $y =$get_date["0"]; //วัน
         $m = $get_date["1"]; //เดือน
       // $d = $get_date["2"]; // ปี
         $d =  substr($get_date["2"],0,2);
         $y1 = $y+543;
         $time = substr($date_time["1"],0,5);
        $time = substr($date_time['1'],0,6);
       return $d.'/'.$m.'/'.$y1.' เวลา '.$time.'00'; //ส่งค่ากลับ
       }
       public function DateToThai($date){
         $get_date = explode("-","$date"); //แยกวันที่
         $date_time = explode(" ","$date"); //แยกวเวลา
         $get_date["2"];
         //echo substr($get_date["2"],0,2);
         $y =$get_date["0"]; //วัน
         $m = $get_date["1"]; //เดือน
       // $d = $get_date["2"]; // ปี
         $d =  substr($get_date["2"],0,2);
         $y1 = $y+543;
         $time = substr($date_time["1"],0,5);
        $time = substr($date_time['1'],0,6);
       return '<span class="glyphicon glyphicon-calendar"></span>'.
              $d.'/'.$m.'/'.$y1.' <span class="glyphicon glyphicon-time"></span> '.$time.'00'; //ส่งค่ากลับ
       }
}
