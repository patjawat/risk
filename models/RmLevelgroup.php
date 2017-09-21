<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_levelgroup".
 *
 * @property string $id
 * @property string $name
 * @property string $color
 * @property string $class
 *
 * @property RmLevel[] $rmLevels
 */
class RmLevelgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_levelgroup';
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
            [['id', 'name'], 'required'],
            [['id'], 'string', 'max' => 1],
            [['name'], 'string', 'max' => 45],
            [['color'], 'string', 'max' => 10],
            [['class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name' => 'กลุ่มระดับความรุนแรง',
            'color' => 'สี',
            'class' => 'Class',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmLevels()
    {
        return $this->hasMany(RmLevel::className(), ['rm_levelgroup_id' => 'id']);
    }
}
