<?php

namespace risk\models;

use Yii;

class PrescriptionItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prescription_items';
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
            [['prescription_error_id', 'drug_items_id', 'rm_event_id'], 'required'],
            [['prescription_error_id', 'drug_items_id', 'rm_event_id'], 'integer'],
            // [['lasa'], 'string'],
            [['authorities_id','lasa','med_employee_id'],'safe'],
            [['details'], 'string', 'max' => 255],
            [['drug_items_id'], 'exist', 'skipOnError' => true, 'targetClass' => DrugItems::className(), 'targetAttribute' => ['drug_items_id' => 'id']],
            [['prescription_error_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrescriptionError::className(), 'targetAttribute' => ['prescription_error_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prescription_error_id' => 'ชื่อความคลาดเคลื่อน',
            'drug_items_id' => 'ชื่อยา',
            'details' => 'รายละเอียดเพิ่มเติม',
            'lasa' => 'ความคลาดเคลื่อนทางยา',
            'rm_event_id' => 'Rm Event ID',
            'id' => 'ID',
            'authorities_id' => 'ผู้สั่งใช้ยา',
            'med_employee_id' => 'ชื่อเจ้าหน้าที่'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugItems()
    {
        return $this->hasOne(DrugItems::className(), ['id' => 'drug_items_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptionError()
    {
        return $this->hasOne(PrescriptionError::className(), ['id' => 'prescription_error_id']);
    }
}
