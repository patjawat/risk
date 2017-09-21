<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_reporttype".
 *
 * @property integer $id
 * @property string $name
 *
 * @property RmEvent[] $rmEvents
 */
class RmReporttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_reporttype';
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
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmEvents()
    {
        return $this->hasMany(RmEvent::className(), ['rm_reporttype_id' => 'id']);
    }
}
