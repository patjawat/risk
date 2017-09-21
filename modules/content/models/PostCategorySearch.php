<?php

namespace risk\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\modules\content\models\PostCategory;

/**
 * PostCategorySearch represents the model behind the search form about `risk\modules\content\models\PostCategory`.
 */
class PostCategorySearch extends PostCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'name'], 'safe'],
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
        $query = PostCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'post_id', $this->post_id])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
