<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\RmArticle;

/**
 * RmArticleSearch represents the model behind the search form about `risk\models\RmArticle`.
 */
class RmArticleSearch extends RmArticle
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['rm_article_category_id', 'name', 'discription', 'title_image', 'start', 'end', 'status', 'created_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RmArticle::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start' => $this->start,
            'end' => $this->end,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'rm_article_category_id', $this->rm_article_category_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'discription', $this->discription])
            ->andFilterWhere(['like', 'title_image', $this->title_image])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
