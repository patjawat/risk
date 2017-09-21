<?php

namespace risk\modules\content\models;

use Yii;
use backend\modules\profile\models\User;
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
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
            [['name', 'content', 'blog_category_id', 'status', 'ref'], 'required'],
            [['content', 'status'], 'string'],
            [['user_id', 'create_at', 'update_at'], 'safe'],
            [['title_image'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 45],
            [['blog_category_id'], 'string', 'max' => 100],
            [['ref'], 'string', 'max' => 50],
            [['blog_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['blog_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'title_image' => 'ภาพประกอบ',
            'name' => 'ชื่อเรื่อง',
            'content' => 'เนื้อหา',
            'user_id' => 'User ID',
            'create_at' => 'สร้าง',
            'update_at' => 'แก้ไข',
            'blog_category_id' => 'หมวดหมู่',
            'status' => 'สถานะ',
            'ref' => 'Ref',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'blog_category_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
