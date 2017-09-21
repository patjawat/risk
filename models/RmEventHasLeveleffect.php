<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_event_has_leveleffect".
 *
 * @property integer $rm_event_id
 * @property string $rm_level_id
 * @property integer $rm_effect_id
 *
 * @property RmEvent $rmEvent
 * @property RmLevelHasEffect $rmLevel
 */
class RmEventHasLeveleffect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_event_has_leveleffect';
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
            [['rm_event_id', 'rm_level_id', 'rm_effect_id'], 'required'],
            [['rm_event_id', 'rm_effect_id'], 'integer'],
            [['rm_level_id'], 'string', 'max' => 1],
            [['rm_event_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmEvent::className(), 'targetAttribute' => ['rm_event_id' => 'id']],
            [['rm_level_id', 'rm_effect_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmLevelHasEffect::className(), 'targetAttribute' => ['rm_level_id' => 'rm_level_id', 'rm_effect_id' => 'rm_effect_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rm_event_id' => 'Rm Event ID',
            'rm_level_id' => 'Rm Level ID',
            'rm_effect_id' => 'Rm Effect ID',
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
    public function getRmLevel()
    {
        return $this->hasOne(RmLevelHasEffect::className(), ['rm_level_id' => 'rm_level_id', 'rm_effect_id' => 'rm_effect_id']);
    }
}
