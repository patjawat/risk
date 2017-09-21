<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_event_has_result".
 *
 * @property integer $rm_event_id
 * @property integer $rm_result_id
 * @property string $name
 *
 * @property RmEvent $rmEvent
 * @property RmResult $rmResult
 */
class RmEventHasResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_event_has_result';
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
            [['rm_event_id', 'rm_result_id', 'name'], 'required'],
            [['rm_event_id', 'rm_result_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['rm_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmEvent::className(), 'targetAttribute' => ['rm_event_id' => 'id']],
            [['rm_result_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmResult::className(), 'targetAttribute' => ['rm_result_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rm_event_id' => 'Rm Event ID',
            'rm_result_id' => 'Rm Result ID',
            'name' => 'ชื่อเรื่อง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvent()
    {
        return $this->hasOne(RmEvent::className(), ['id' => 'rm_event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmResult()
    {
        return $this->hasOne(RmResult::className(), ['id' => 'rm_result_id']);
    }
}
