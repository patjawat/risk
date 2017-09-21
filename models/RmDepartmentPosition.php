<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_department_position".
 *
 * @property integer $id
 * @property string $name
 * @property string $department_id
 */
class RmDepartmentPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_department_position';
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
            [['name', 'department_id'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['department_id'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'department_id' => 'แผนก/ฝ่าย',
        ];
    }

    public function getDepartment(){
        return $this->hasOne(Department::className(),['department_id' => 'department_id']);
    }
}
