<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "administration_items".
 *
 * @property integer $administration_error_id
 * @property integer $drug_items_id
 * @property string $details
 * @property string $lasa
 * @property integer $rm_event_id
 * @property integer $id
 * @property string $authorities_id
 *
 * @property AdministrationError $administrationError
 * @property DrugItems $drugItems
 */
class AdministrationItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administration_items';
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
            [['administration_error_id', 'drug_items_id', 'rm_event_id'], 'required'],
            [['administration_error_id', 'drug_items_id', 'rm_event_id'], 'integer'],
            [['lasa'], 'string'],
            [['details'], 'string', 'max' => 255],
            [['authorities_id','med_employee_id'],'safe'],
            [['administration_error_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdministrationError::className(), 'targetAttribute' => ['administration_error_id' => 'id']],
            [['drug_items_id'], 'exist', 'skipOnError' => true, 'targetClass' => DrugItems::className(), 'targetAttribute' => ['drug_items_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'administration_error_id' => 'ชื่อความคลาดเคลื่อน',
            'drug_items_id' => 'ชื่อยา',
            'details' => 'รายละเอียดเพิ่มเติม',
            'lasa' => 'Lasa',
            'rm_event_id' => 'Rm Event ID',
            'id' => 'ID',
            'authorities_id' => 'ผู้บริหารยา',
            'med_employee_id' => 'ชื่อเจ้าหน้าที่'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrationError()
    {
        return $this->hasOne(AdministrationError::className(), ['id' => 'administration_error_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugItems()
    {
        return $this->hasOne(DrugItems::className(), ['id' => 'drug_items_id']);
    }
}
