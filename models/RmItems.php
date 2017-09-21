<?php

namespace risk\models;

use Yii;

class RmItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_items';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('risk');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rm_group_id', 'rm_workgroup_id', 'rm_type_id', 'name'], 'required'],
            [['rm_group_id', 'rm_workgroup_id'], 'string', 'max' => 5],
            [['specific_clinical_id'], 'string', 'max' => 50],
            [['rm_type_id'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 255],
            [['rm_group_id', 'rm_workgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmGroup::className(), 'targetAttribute' => ['rm_group_id' => 'id', 'rm_workgroup_id' => 'rm_workgroup_id']],
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
            'rm_group_id' => 'โปรแกรมความเสี่ยง',
            'rm_workgroup_id' => 'กลุ่มงานที่ได้รับมอบหมาย',
            'rm_type_id' => 'ประเภท',
            'specific_clinical_id' => 'คลินิกเฉพาะทาง',
            'name' => 'ชื่อความเสี่ยง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvents()
    {
        return $this->hasMany(RmEvent::className(), ['rm_items_id' => 'id', 'rm_group_id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id', 'rm_type_id' => 'rm_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmGroup()
    {
        return $this->hasOne(RmGroup::className(), ['id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmType()
    {
        return $this->hasOne(RmType::className(), ['id' => 'rm_type_id']);
    }
}
