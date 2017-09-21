<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\RmItems;

/**
 * RmItemsSearch represents the model behind the search form about `risk\models\RmItems`.
 */
class RmItemsSearch extends RmItems
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['rm_group_id', 'rm_workgroup_id', 'rm_type_id', 'name', 'specific_clinical_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RmItems::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'rm_group_id', $this->rm_group_id])
            ->andFilterWhere(['like', 'rm_workgroup_id', $this->rm_workgroup_id])
            ->andFilterWhere(['like', 'rm_type_id', $this->rm_type_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'specific_clinical_id', $this->specific_clinical_id]);

        return $dataProvider;
    }
}
