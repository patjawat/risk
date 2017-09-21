<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_effect".
 *
 * @property integer $id
 * @property string $name
 *
 * @property RmLevelHasEffect[] $rmLevelHasEffects
 * @property RmLevel[] $rmLevels
 */
class RmEffect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_effect';
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevelHasEffects()
    {
        return $this->hasMany(RmLevelHasEffect::className(), ['rm_effect_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevels()
    {
        return $this->hasMany(RmLevel::className(), ['id' => 'rm_level_id'])->viaTable('rm_level_has_effect', ['rm_effect_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RmEffectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RmEffectQuery(get_called_class());
    }
}
