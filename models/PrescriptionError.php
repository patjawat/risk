<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "prescription_error".
 *
 * @property integer $id
 * @property string $name
 *
 * @property PrescriptionItems[] $prescriptionItems
 */
class PrescriptionError extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prescription_error';
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
            'name' => 'ชื่อรายการ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptionItems()
    {
        return $this->hasMany(PrescriptionItems::className(), ['prescription_error_id' => 'id']);
    }
}
