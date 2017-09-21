<?php

namespace risk\modules\content\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $title
 * @property string $title_image
 * @property string $file
 * @property string $create_at
 * @property string $update_at
 * @property integer $user_id
 * @property string $post_category_id
 * @property string $status
 *
 * @property PostCategory $postCategory
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
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
            [['id', 'title', 'post_category_id', 'status'], 'required'],
            [['file', 'status'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['user_id'], 'integer'],
            [['id', 'title', 'title_image', 'post_category_id'], 'string', 'max' => 100],
            [['post_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['post_category_id' => 'post_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'title_image' => 'Title Image',
            'file' => 'File',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'user_id' => 'User ID',
            'post_category_id' => 'หมวดหมู่',
            'status' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::className(), ['post_id' => 'post_category_id']);
    }
}
