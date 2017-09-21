<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_event_has_how".
 *
 * @property integer $rm_event_id
 * @property integer $how_id
 *
 * @property RmHow $how
 * @property RmEvent $rmEvent
 */
class RmEventHasHow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_event_has_how';
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
            [['rm_event_id', 'how_id'], 'required'],
            [['rm_event_id', 'how_id'], 'integer'],
            [['how_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmHow::className(), 'targetAttribute' => ['how_id' => 'id']],
            [['rm_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmEvent::className(), 'targetAttribute' => ['rm_event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rm_event_id' => 'Rm Event ID',
            'how_id' => 'How ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHow()
    {
        return $this->hasOne(RmHow::className(), ['id' => 'how_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvent()
    {
        return $this->hasOne(RmEvent::className(), ['id' => 'rm_event_id']);
    }
}
