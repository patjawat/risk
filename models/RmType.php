<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_type".
 *
 * @property string $id
 * @property string $name
 *
 * @property RmItems[] $rmItems
 */
class RmType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_type';
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
            [['id'], 'string', 'max' => 10],
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
            'name' => 'ชื่อประเภท',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmItems()
    {
        return $this->hasMany(RmItems::className(), ['rm_type_id' => 'id']);
    }
}
