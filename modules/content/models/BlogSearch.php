<?php

namespace risk\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\modules\content\models\Blog;

/**
 * BlogSearch represents the model behind the search form about `risk\modules\content\models\Blog`.
 */
class BlogSearch extends Blog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title_image', 'name', 'content', 'user_id', 'create_at', 'update_at', 'blog_category_id', 'status', 'ref'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Blog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'title_image', $this->title_image])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'blog_category_id', $this->blog_category_id])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
