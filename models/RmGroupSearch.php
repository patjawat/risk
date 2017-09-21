<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\RmGroup;

/**
 * RmGroupSearch represents the model behind the search form about `risk\models\RmGroup`.
 */
class RmGroupSearch extends RmGroup
{
    public function rules()
    {
        return [
            [['id', 'rm_workgroup_id', 'name', 'discription'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RmGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'rm_workgroup_id', $this->rm_workgroup_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'discription', $this->discription]);

        return $dataProvider;
    }
}
