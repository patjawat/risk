<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\MedError;

/**
 * MedErrorSearch represents the model behind the search form about `risk\models\MedError`.
 */
class MedErrorSearch extends MedError
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rm_event_id', 'med_items_id', 'med_type_id', 'med_employee_id'], 'integer'],
            [['lasa', 'note'], 'safe'],
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
        $query = MedError::find();

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
            'rm_event_id' => $this->rm_event_id,
            'med_items_id' => $this->med_items_id,
            'med_type_id' => $this->med_type_id,
            'med_employee_id' => $this->med_employee_id,
        ]);

        $query->andFilterWhere(['like', 'lasa', $this->lasa])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
