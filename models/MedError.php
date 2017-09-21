<?php

namespace risk\models;

use Yii;

class MedError extends \yii\db\ActiveRecord
{
public $name;
public $rowid;
    public static function tableName()
    {
        return 'med_error';
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
            [['med_items_id'], 'required'],
            [['rm_event_id', 'med_items_id'], 'integer'],
             [['rm_event_id','med_type_id','med_employee_id','name','note','lasa','rowid'], 'safe'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rm_event_id' => 'Rm Event ID',
            'med_items_id' => 'ชื่อความคลาดเคลื่อน',
            'note' => 'รายละเอียด',
            'med_employee_id' => 'เจ้าหน้าที่ผู้เกี่ยวข้อง',
            'med_type_id' => 'ประเภท',
            'name' => 'ชื่อความคลาดเคลื่อน'
        ];
    }
}
