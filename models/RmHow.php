<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_how".
 *
 * @property integer $id
 * @property string $name
 *
 * @property RmEventHasHow[] $rmEventHasHows
 * @property RmEvent[] $rmEvents
 */
class RmHow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_how';
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
            [['id'], 'integer'],
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
    public function getRmEventHasHows()
    {
        return $this->hasMany(RmEventHasHow::className(), ['how_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvents()
    {
        return $this->hasMany(RmEvent::className(), ['id' => 'rm_event_id'])->viaTable('rm_event_has_how', ['how_id' => 'id']);
    }
}
