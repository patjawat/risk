<?php

namespace risk\models;

use Yii;

class DrugItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drugitems';
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
            [['generic_name'], 'string', 'max' => 45],
            [['code','name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'icode' => 'รหัสยา',
            'generic_name' => 'ชื่อสามัญ',
            'name' => 'ชื่อเวชภัณฑ์'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrationItems()
    {
        return $this->hasMany(AdministrationItems::className(), ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrationErrors()
    {
        return $this->hasMany(AdministrationError::className(), ['id' => 'administration_error_id'])->viaTable('administration_items', ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispensingItems()
    {
        return $this->hasMany(DispensingItems::className(), ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispensingErrors()
    {
        return $this->hasMany(DispensingError::className(), ['id' => 'dispensing_error_id'])->viaTable('dispensing_items', ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreDispensingItems()
    {
        return $this->hasMany(PreDispensingItems::className(), ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreDispensingErrors()
    {
        return $this->hasMany(PreDispensingError::className(), ['id' => 'pre_dispensing_error_id'])->viaTable('pre_dispensing_items', ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptionItems()
    {
        return $this->hasMany(PrescriptionItems::className(), ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptionErrors()
    {
        return $this->hasMany(PrescriptionError::className(), ['id' => 'prescription_error_id'])->viaTable('prescription_items', ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranscribingItems()
    {
        return $this->hasMany(TranscribingItems::className(), ['drug_items_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranscribingErrors()
    {
        return $this->hasMany(TranscribingError::className(), ['id' => 'transcribing_error_id'])->viaTable('transcribing_items', ['drug_items_id' => 'id']);
    }
}
