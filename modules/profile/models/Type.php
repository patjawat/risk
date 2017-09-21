<?php

namespace risk\modules\profile\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property string $type_id
 * @property string $name
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'required'],
            [['type_id'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'รหัสประเภท',
            'name' => 'ประเถทหน่วยงาน',
        ];
    }
}
