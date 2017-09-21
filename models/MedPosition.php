<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "med_position".
 *
 * @property integer $id
 * @property string $name
 *
 * @property MedEmployee[] $medEmployees
 */
class MedPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'med_position';
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
            'name' => 'ชื่อตำแหน่ง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedEmployees()
    {
        return $this->hasMany(MedEmployee::className(), ['med_position_id' => 'id']);
    }
}
