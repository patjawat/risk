<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "transcribing_items".
 *
 * @property integer $transcribing_error_id
 * @property integer $drug_items_id
 * @property string $details
 * @property integer $rm_event_id
 * @property integer $id
 * @property string $lasa
 * @property string $authorities_id
 *
 * @property DrugItems $drugItems
 * @property TranscribingError $transcribingError
 */
class TranscribingItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transcribing_items';
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
            [['transcribing_error_id', 'drug_items_id', 'rm_event_id'], 'required'],
            [['transcribing_error_id', 'drug_items_id', 'rm_event_id'], 'integer'],
            [['details'], 'string', 'max' => 255],
            [['authorities_id','med_employee_id'],'safe'],
            [['lasa'], 'string', 'max' => 10],
            [['drug_items_id'], 'exist', 'skipOnError' => true, 'targetClass' => DrugItems::className(), 'targetAttribute' => ['drug_items_id' => 'id']],
            [['transcribing_error_id'], 'exist', 'skipOnError' => true, 'targetClass' => TranscribingError::className(), 'targetAttribute' => ['transcribing_error_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transcribing_error_id' => 'ชื่อความคลาดเคลื่อน',
            'drug_items_id' => 'ชื่อยา',
            'details' => 'รายละเอียดเพิ่มเติม',
            'rm_event_id' => 'เลขที่ความเสี่ยง',
            'id' => 'รหัส',
            'lasa' => 'ความคลาดเคลื่อนทางยา',
            'authorities_id' => 'ผู้คัดลอกยา',
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
    public function getTranscribingError()
    {
        return $this->hasOne(TranscribingError::className(), ['id' => 'transcribing_error_id']);
    }
}
