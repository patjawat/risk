<?php

namespace risk\models;

use Yii;


class RmGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_group';
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
            [['id', 'rm_workgroup_id', 'name', 'discription'], 'required'],
            [['id', 'rm_workgroup_id'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['discription'], 'string', 'max' => 255],
            [['rm_workgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmWorkgroup::className(), 'targetAttribute' => ['rm_workgroup_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'rm_workgroup_id' => 'กลุ่มงานที่ได้รับมอบหมาย',
            'name' => 'ชื่อโปรแกรม',
            'discription' => 'ความหมาย',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmWorkgroup()
    {
        return $this->hasOne(RmWorkgroup::className(), ['id' => 'rm_workgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmItems()
    {
        return $this->hasMany(RmItems::className(), ['rm_group_id' => 'id', 'rm_workgroup_id' => 'rm_workgroup_id']);
    }
}
