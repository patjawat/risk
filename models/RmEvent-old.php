<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_event".
 *
 * @property integer $id
 * @property string $ref
 * @property string $rm_type_id
 * @property integer $rm_items_id
 * @property string $rm_group_id
 * @property string $rm_workgroup_id
 * @property string $rm_level_id
 * @property string $rm_levelgroup_id
 * @property integer $rm_department_position_id
 * @property string $department_id
 * @property string $event_date
 * @property string $event_time
 * @property string $report_date
 * @property string $report_time
 * @property string $accident
 * @property string $accident_name
 * @property integer $age
 * @property string $hn
 * @property string $an
 * @property string $rm_event_note
 * @property string $editing
 * @property string $editing_note
 * @property string $urgent
 * @property integer $reporter
 * @property string $related
 * @property string $images
 * @property string $review
 * @property string $drug_size
 * @property string $drug_level
 * @property string $drug_count
 * @property string $drug_alert_time
 * @property string $drug_alert_level
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
 *
 * @property RmDepartmentPosition $rmDepartmentPosition
 * @property RmItems $rmItems
 * @property RmLevel $rmLevel
 * @property RmType $rmType
 */
class RmEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['ref', 'rm_type_id', 'rm_items_id', 'rm_group_id', 'rm_workgroup_id', 'rm_level_id', 'rm_levelgroup_id', 'rm_department_position_id', 'department_id', 'accident', 'editing', 'urgent'], 'required'],
            [['ref', 'accident', 'editing', 'urgent', 'images', 'review', 'drug_size', 'drug_level', 'drug_count', 'drug_alert_time', 'drug_alert_level'], 'string'],
            [['rm_items_id', 'rm_department_position_id', 'age', 'reporter'], 'integer'],
            [['event_date', 'event_time', 'report_date', 'report_time'], 'safe'],
            [['rm_type_id', 'administration_type'], 'string', 'max' => 4],
            [['rm_group_id', 'rm_workgroup_id', 'prescription_laza', 'transcribing_laza', 'administration_laza', 'dispensing_laza', 'pre_dispensing_laza'], 'string', 'max' => 5],
            [['rm_level_id', 'rm_levelgroup_id'], 'string', 'max' => 1],
            [['department_id'], 'string', 'max' => 50],
            [['accident_name', 'hn', 'an'], 'string', 'max' => 45],
            [['rm_event_note', 'editing_note', 'related', 'prescription_error', 'pre_dispensing_error', 'transcribing_error', 'administration_error', 'dispensing_error', 'prescription_error_note', 'pre_dispensing_error_note', 'transcribing_error_note', 'administration_error_note', 'dispensing_error_note'], 'string', 'max' => 255],
            [['prescription_name', 'prescription_name2', 'transcribing_name', 'administration_name', 'dispensing_name', 'pre_dispensing_man', 'pre_dispensing_check'], 'string', 'max' => 100],
            [['rm_department_position_id', 'department_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmDepartmentPosition::className(), 'targetAttribute' => ['rm_department_position_id' => 'id', 'department_id' => 'department_id']],
            [['rm_items_id', 'rm_group_id', 'rm_workgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmItems::className(), 'targetAttribute' => ['rm_items_id' => 'id', 'rm_group_id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id']],
            [['rm_level_id', 'rm_levelgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmLevel::className(), 'targetAttribute' => ['rm_level_id' => 'id', 'rm_levelgroup_id' => 'rm_levelgroup_id']],
            [['rm_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmType::className(), 'targetAttribute' => ['rm_type_id' => 'id']],
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
            'rm_type_id' => 'ประเภท',
            'rm_items_id' => 'ชื่อความเสี่ยง',
            'rm_group_id' => 'โปรแกรมความเสี่ยง',
            'rm_workgroup_id' => 'Rm Workgroup ID',
            'rm_level_id' => 'ระดับความรุนแรง',
            'rm_levelgroup_id' => 'ระดับความเสี่ยง',
            'rm_department_position_id' => 'จุดเกิดเหตุ',
            'department_id' => 'สถานที่เกิดเหตุ',
            'event_date' => 'วันเกิดเหตุ',
            'event_time' => 'เวลา',
            'report_date' => 'วันที่รายงาน',
            'report_time' => 'เวลารายงาน',
            'accident' => 'ผู้ประสบเหตุการณ',
            'accident_name' => 'ชื่อผู้ประสบเหตุ',
            'age' => 'อายุ',
            'hn' => 'Hn',
            'an' => 'An',
            'rm_event_note' => 'สรุปปัญหา/เหตุการณโดยย่อ',
            'editing' => 'การแก้ไขเบื้องต้น',
            'editing_note' => 'วิธีการแก้ปัญหาดังนี้',
            'urgent' => 'ความเร่งด่วน',
            'reporter' => 'ผู้รายงาน',
            'related' => 'หน่วยงานที่เกดี่ยวข้อง',
            'images' => 'ภาพประกอบ',
            'review' => 'การทบทวน',
            'drug_size' => 'ขนาดยาของยา',
            'drug_level' => 'ความแรงของยา',
            'drug_count' => 'จำนวนยาที่จ่าย',
            'drug_alert_time' => 'ระยะเวลาการให้ยาผิด',
            'drug_alert_level' => 'อัตราการให้ยาผิด',
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
        return $this->hasOne(RmItems::className(), ['id' => 'rm_items_id', 'rm_group_id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id']);
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
    public function getRmType()
    {
        return $this->hasOne(RmType::className(), ['id' => 'rm_type_id']);
    }
}
