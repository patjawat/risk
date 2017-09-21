<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_result".
 *
 * @property integer $id
 * @property string $name
 *
 * @property RmEventHasResult[] $rmEventHasResults
 * @property RmEvent[] $rmEvents
 */
class RmResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_result';
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
            [['id'], 'required'],
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
    public function getRmEventHasResults()
    {
        return $this->hasMany(RmEventHasResult::className(), ['rm_result_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvents()
    {
        return $this->hasMany(RmEvent::className(), ['id' => 'rm_event_id'])->viaTable('rm_event_has_result', ['rm_result_id' => 'id']);
    }
}
