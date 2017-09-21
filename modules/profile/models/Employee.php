<?php

namespace risk\modules\profile\models;

use Yii;

class Employee extends \yii\db\ActiveRecord
{

 public $items_id;
    public static function tableName()
    {
        return 'employee';
    }

    public function rules()
    {
        return [

            [['gender'], 'string'],
            [['birthday','items_id','branch_id'], 'safe'],
            [['department_id', 'position_id', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['cid'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name' => 'ชื่อ-สกุล',
            'gender' => 'เพศ',
            'cid' => 'เลขที่บัตรประชาชน',
            'birthday' => 'วันเกิด',
            'department_id' => 'แผนก/ฝ่าย',
            'position_id' => 'ตำแหน่ง',
            'user_id' => 'รหัสผู้ใช้งาน',
            'items_id' => 'สิทธิการใช้งาน',
            'branch_id' => 'หน่วยงาน'
         ];
    }
     public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['branch_id' => 'branch_id']);
    }
    public function getDepartment()
   {
       return $this->hasOne(Department::className(), ['department_id' => 'department_id']);
   }
}
