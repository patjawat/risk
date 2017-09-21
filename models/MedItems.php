<?php

namespace risk\models;

use Yii;


class MedItems extends \yii\db\ActiveRecord
{
  public $med_items_id;
  public $med_employee_id;
  public $lasa;
  public $note;
  public $rm_event_id;

    public static function tableName()
    {
        return 'med_items';
    }

    public static function getDb()
    {
        return Yii::$app->get('risk');
    }

    public function rules()
    {
        return [
            [['med_type_id', 'name'], 'required'],
            [['med_type_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
             [['med_items_id','med_employee_id','lasa','note'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'med_type_id' => 'ประเภท',
            'name' => 'ความเสี่ยง',
            'med_employee_id' => 'เจ้าหน้าที่ผู้เกี่ยวข้อง',
            'note' => 'อื่นๆ....'
        ];
    }
    public function getMedType()
    {
        return $this->hasOne(MedType::className(), ['id' => 'med_type_id']);
    }
}
