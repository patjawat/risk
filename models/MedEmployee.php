<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "med_employee".
 *
 * @property integer $id
 * @property string $name
 * @property string $status
 * @property integer $med_position_id
 *
 * @property MedPosition $medPosition
 */
class MedEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'med_employee';
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
            [['name', 'status', 'med_position_id'], 'required'],
            [['status'], 'string'],
            [['med_position_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['med_position_id'], 'exist', 'skipOnError' => true, 'targetClass' => MedPosition::className(), 'targetAttribute' => ['med_position_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ-นามสกุล',
            'status' => 'สถานะ',
            'med_position_id' => 'ตำแหน่ง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedPosition()
    {
        return $this->hasOne(MedPosition::className(), ['id' => 'med_position_id']);
    }
}
