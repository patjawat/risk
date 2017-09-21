<?php

namespace risk\modules\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\modules\profile\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `risk\modules\profile\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'position_id', 'user_id'], 'integer'],
            [['name', 'gender', 'cid', 'birthday','branch_id'], 'safe'],
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
        $query = Employee::find();

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
            'birthday' => $this->birthday,
            'department_id' => $this->department_id,
            'position_id' => $this->position_id,
            'user_id' => $this->user_id,
            'branch_id' => $this->branch_id
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'cid', $this->cid]);

        return $dataProvider;
    }
}
