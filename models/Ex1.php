<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "ex1".
 *
 * @property integer $id
 * @property string $date
 * @property string $datetime
 */
class Ex1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ex1';
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
            [['date', 'datetime'], 'required'],
            [['date', 'datetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'datetime' => 'Datetime',
        ];
    }
}
