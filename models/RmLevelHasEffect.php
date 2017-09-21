<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_level_has_effect".
 *
 * @property string $rm_level_id
 * @property integer $rm_effect_id
 * @property string $name
 *
 * @property RmEventHasLeveleffect[] $rmEventHasLeveleffects
 * @property RmEvent[] $rmEvents
 * @property RmEffect $rmEffect
 * @property RmLevel $rmLevel
 */
class RmLevelHasEffect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_level_has_effect';
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
            [['rm_level_id', 'rm_effect_id'], 'required'],
            [['rm_effect_id'], 'integer'],
            [['rm_level_id'], 'string', 'max' => 1],
            [['name'], 'string', 'max' => 255],
            [['rm_effect_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmEffect::className(), 'targetAttribute' => ['rm_effect_id' => 'id']],
            [['rm_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmLevel::className(), 'targetAttribute' => ['rm_level_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rm_level_id' => 'Rm Level ID',
            'rm_effect_id' => 'Rm Effect ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEventHasLeveleffects()
    {
        return $this->hasMany(RmEventHasLeveleffect::className(), ['rm_level_id' => 'rm_level_id', 'rm_effect_id' => 'rm_effect_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvents()
    {
        return $this->hasMany(RmEvent::className(), ['id' => 'rm_event_id'])->viaTable('rm_event_has_leveleffect', ['rm_level_id' => 'rm_level_id', 'rm_effect_id' => 'rm_effect_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEffect()
    {
        return $this->hasOne(RmEffect::className(), ['id' => 'rm_effect_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevel()
    {
        return $this->hasOne(RmLevel::className(), ['id' => 'rm_level_id']);
    }
}
