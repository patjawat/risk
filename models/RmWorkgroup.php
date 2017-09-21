<?php

namespace risk\models;

use Yii;

/**
 * This is the model class for table "rm_workgroup".
 *
 * @property string $id
 * @property string $name
 *
 * @property RmGroup[] $rmGroups
 */
class RmWorkgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_workgroup';
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
            [['id', 'name'], 'required'],
            [['id'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสทีม',
            'name' => 'ชื่อทีมคล่อม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmGroups()
    {
        return $this->hasMany(RmGroup::className(), ['rm_workgroup_id' => 'id']);
    }
}
