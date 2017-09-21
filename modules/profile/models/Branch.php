<?php

namespace risk\modules\profile\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property string $branch_id
 * @property string $branch_name
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'branch_name'], 'required'],
            [['branch_id'], 'string', 'max' => 10],
            [['branch_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'รหัส',
            'branch_name' => 'ชื่อสาขา',
        ];
    }
}
