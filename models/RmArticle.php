<?php

namespace risk\models;

use Yii;

class RmArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rm_article';
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
            [['rm_article_category_id', 'name', 'discription', 'status', 'created_at'], 'required'],
            [['discription', 'title_image', 'status'], 'string'],
            [['start', 'end', 'created_at'], 'safe'],
            [['rm_article_category_id'], 'string', 'max' => 11],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rm_article_category_id' => 'หมวดหมู่',
            'name' => 'ชื่อเรื่อง',
            'discription' => 'รายละเอียดเนื้อหา',
            'title_image' => 'รูปภาพเริ่มต้น',
            'start' => 'เริ่มแสดง',
            'end' => 'สิ้นสุด',
            'status' => 'สานะ',
            'created_at' => 'สร้างเมื่อ',
        ];
    }
    public function getCategory(){
      return $this->hasOne(RmArticleCategory::className(),['id' => 'rm_article_category_id']);
    }
}
