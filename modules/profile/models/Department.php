<?php

namespace risk\modules\profile\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property string $department_id
 * @property string $name
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id'], 'required'],
            [['department_id'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'รหัสแผนก',
            'name' => 'ชื่อแผนก',
        ];
    }
}
