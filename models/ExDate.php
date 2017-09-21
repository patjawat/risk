<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "ex_date".
 *
 * @property integer $id
 * @property string $start
 * @property string $end
 * @property string $ex_datecol
 */
class ExDate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ex_date';
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
            [['start', 'end'], 'safe'],
            [['ex_datecol'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start' => 'Start',
            'end' => 'End',
            'ex_datecol' => 'Ex Datecol',
        ];
    }
}
