<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_level".
 *
 * @property string $id
 * @property string $rm_levelgroup_id
 * @property string $name
 * @property string $discription
 * @property string $color
 * @property string $class
 *
 * @property RmEvent[] $rmEvents
 * @property RmLevelgroup $rmLevelgroup
 * @property RmLevelHasEffect[] $rmLevelHasEffects
 * @property RmEffect[] $rmEffects
 */
class RmLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_level';
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
            [['id', 'rm_levelgroup_id', 'name'], 'required'],
            [['id', 'rm_levelgroup_id'], 'string', 'max' => 1],
            [['name', 'discription', 'class'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 10],
            [['rm_levelgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmLevelgroup::className(), 'targetAttribute' => ['rm_levelgroup_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'rm_levelgroup_id' => 'ระดับความเสี่ยง',
            'name' => 'ชื่อ',
            'discription' => 'รายละเอียด',
            'color' => 'สี',
            'class' => 'Class',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvents()
    {
        return $this->hasMany(RmEvent::className(), ['rm_level_id' => 'id', 'rm_levelgroup_id' => 'rm_levelgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevelgroup()
    {
        return $this->hasOne(RmLevelgroup::className(), ['id' => 'rm_levelgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevelHasEffects()
    {
        return $this->hasMany(RmLevelHasEffect::className(), ['rm_level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEffects()
    {
        return $this->hasMany(RmEffect::className(), ['id' => 'rm_effect_id'])->viaTable('rm_level_has_effect', ['rm_level_id' => 'id']);
    }
}
