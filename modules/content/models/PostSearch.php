<?php

namespace risk\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\modules\content\models\Post;

/**
 * PostSearch represents the model behind the search form about `risk\modules\content\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'title_image', 'file', 'create_at', 'update_at', 'post_category_id', 'status'], 'safe'],
            [['user_id'], 'integer'],
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
        $query = Post::find();

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
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_image', $this->title_image])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'post_category_id', $this->post_category_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
