<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\RmLevel;

/**
 * RmLevelSearch represents the model behind the search form about `risk\models\RmLevel`.
 */
class RmLevelSearch extends RmLevel
{
    public function rules()
    {
        return [
            [['id', 'rm_levelgroup_id', 'name', 'discription', 'color', 'class', 'rm_type_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RmLevel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'rm_levelgroup_id', $this->rm_levelgroup_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'discription', $this->discription])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'rm_type_id', $this->rm_type_id]);

        return $dataProvider;
    }
}
