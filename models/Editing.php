<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "editing".
 *
 * @property string $id
 * @property string $name
 *
 * @property RmEvent[] $rmEvents
 */
class Editing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'editing';
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
            [['id'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name' => 'ชื่อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvents()
    {
        return $this->hasMany(RmEvent::className(), ['editing_id' => 'id']);
    }
}
