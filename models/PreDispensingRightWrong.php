<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "pre_dispensing_right_wrong".
 *
 * @property integer $id
 * @property string $right
 * @property string $wrong
 * @property integer $rm_event_id
 */
class PreDispensingRightWrong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pre_dispensing_right_wrong';
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
            [['rm_event_id'], 'integer'],
            [['right', 'wrong'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'right' => 'ถูก
',
            'wrong' => 'ผิด',
            'rm_event_id' => 'Rm Event ID',
        ];
    }
}
