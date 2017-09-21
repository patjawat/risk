<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\RmDepartmentPosition;

/**
 * RmDepartmentPsitionSearch represents the model behind the search form about `risk\models\RmDepartmentPosition`.
 */
class RmDepartmentPsitionSearch extends RmDepartmentPosition
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['department_id', 'name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RmDepartmentPosition::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'department_id', $this->department_id])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
