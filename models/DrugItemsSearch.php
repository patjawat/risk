<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\DrugItems;

/**
 * DrugItemsSearch represents the model behind the search form about `risk\models\DrugItems`.
 */
class DrugItemsSearch extends DrugItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icode'], 'integer'],
            [['generic_name','name'], 'safe'],
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
        $query = DrugItems::find();

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
            'icode' => $this->icode,
        ]);

        $query->andFilterWhere(['like', 'generic_name', $this->generic_name]);

        return $dataProvider;
    }
}
