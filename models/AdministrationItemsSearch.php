<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\AdministrationItems;

/**
 * AdministrationItemsSearch represents the model behind the search form about `risk\models\AdministrationItems`.
 */
class AdministrationItemsSearch extends AdministrationItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['administration_error_id', 'drug_items_id', 'rm_event_id', 'id'], 'integer'],
            [['details', 'lasa'], 'safe'],
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
        $query = AdministrationItems::find();

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
            'administration_error_id' => $this->administration_error_id,
            'drug_items_id' => $this->drug_items_id,
            'rm_event_id' => $this->rm_event_id,
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'lasa', $this->lasa]);

        return $dataProvider;
    }
}
