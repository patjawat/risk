<?php

namespace risk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use risk\models\RmEvent;

/**
 * RmEventSearch represents the model behind the search form about `risk\models\RmEvent`.
 */
class RmEventSearch extends RmEvent
{
  public  $date1;
  public  $date2;
  public  $multigroup;
    public function rules()
    {
        return [
            [['id', 'rm_items_id', 'rm_reporttype_id', 'rm_department_position_id', 'age', 'reporter'], 'integer'],
            [['ref', 'rm_level_id', 'rm_levelgroup_id', 'rm_group_id', 'rm_workgroup_id', 'rm_type_id', 'rm_type_id1', 'department_id', 'rca_date', 'accident_id', 'urgent_id', 'editing_id', 'review_date', 'check_date', 'event_date', 'report_date', 'accident_name', 'hn', 'an', 'rm_event_note', 'editing_note', 'related', 'images', 'review', 'prescription_error', 'prescription_laza', 'prescription_name', 'prescription_name2', 'pre_dispensing_error', 'transcribing_error', 'transcribing_laza', 'transcribing_name', 'administration_error', 'administration_laza', 'administration_type', 'administration_name', 'dispensing_error', 'dispensing_laza', 'dispensing_name', 'prescription_error_note', 'pre_dispensing_error_note', 'transcribing_error_note', 'administration_error_note', 'dispensing_error_note', 'pre_dispensing_laza', 'pre_dispensing_man', 'pre_dispensing_check', 'review_teme', 'wi', 'wi_name', 'sp', 'sp_name', 'cpg_cnpg', 'cpg_cnpg_name', 'created_at', 'delete', 'effect', 'lasa','date1','date2','multigroup'], 'safe'],
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
        $query = RmEvent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['event_date' =>SORT_DESC ]]
        ]);
        //$dataProvider->query->joinWith('rmgroup','rmItems');
        //$dataProvider->query->joinWith(['rmItems'] );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere([
            'id' => $this->id,
            'rm_items_id' => $this->rm_items_id,
            'rm_reporttype_id' => $this->rm_reporttype_id,
            'rm_department_position_id' => $this->rm_department_position_id,
            'rca_date' => $this->rca_date,
            'review_date' => $this->review_date,
            'check_date' => $this->check_date,
            //'event_date' => $this->event_date,
            'report_date' => $this->report_date,
            'age' => $this->age,
            'reporter' => $this->reporter,
            'review_teme' => $this->review_teme,
            'created_at' => $this->created_at,
            'delete' => $this->delete,
            'rm_event.rm_type_id' => $this->rm_type_id,
        ]);
        $query//->andFilterWhere(['>=', 'event_date', $this->date1])
              //->andFilterWhere(['<=', 'event_date', $this->date2])
              //->andFilterWhere(['like', 'event_date', $this->date1])
              ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'rm_level_id', $this->rm_level_id])
            ->andFilterWhere(['like', 'rm_levelgroup_id', $this->rm_levelgroup_id])
            ->andFilterWhere(['like', 'rm_event.rm_group_id', $this->rm_group_id])
            ->andFilterWhere(['like', 'rm_event.rm_workgroup_id', $this->rm_workgroup_id])
            //->andFilterWhere(['like', 'rm_items.rm_type_id', $this->rm_type_id])
            ->andFilterWhere(['like', 'rm_type_id1', $this->rm_type_id1])
            ->andFilterWhere(['like', 'department_id', $this->department_id])
            ->andFilterWhere(['like', 'accident_id', $this->accident_id])
            ->andFilterWhere(['like', 'urgent_id', $this->urgent_id])
            ->andFilterWhere(['like', 'editing_id', $this->editing_id])
            ->andFilterWhere(['like', 'accident_name', $this->accident_name])
            ->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'an', $this->an])
            ->andFilterWhere(['like', 'rm_event_note', $this->rm_event_note])
            ->andFilterWhere(['like', 'editing_note', $this->editing_note])
            ->andFilterWhere(['like', 'related', $this->related])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'review', $this->review])
            ->andFilterWhere(['like', 'prescription_error', $this->prescription_error])
            ->andFilterWhere(['like', 'prescription_laza', $this->prescription_laza])
            ->andFilterWhere(['like', 'prescription_name', $this->prescription_name])
            ->andFilterWhere(['like', 'prescription_name2', $this->prescription_name2])
            ->andFilterWhere(['like', 'pre_dispensing_error', $this->pre_dispensing_error])
            ->andFilterWhere(['like', 'transcribing_error', $this->transcribing_error])
            ->andFilterWhere(['like', 'transcribing_laza', $this->transcribing_laza])
            ->andFilterWhere(['like', 'transcribing_name', $this->transcribing_name])
            ->andFilterWhere(['like', 'administration_error', $this->administration_error])
            ->andFilterWhere(['like', 'administration_laza', $this->administration_laza])
            ->andFilterWhere(['like', 'administration_type', $this->administration_type])
            ->andFilterWhere(['like', 'administration_name', $this->administration_name])
            ->andFilterWhere(['like', 'dispensing_error', $this->dispensing_error])
            ->andFilterWhere(['like', 'dispensing_laza', $this->dispensing_laza])
            ->andFilterWhere(['like', 'dispensing_name', $this->dispensing_name])
            ->andFilterWhere(['like', 'prescription_error_note', $this->prescription_error_note])
            ->andFilterWhere(['like', 'pre_dispensing_error_note', $this->pre_dispensing_error_note])
            ->andFilterWhere(['like', 'transcribing_error_note', $this->transcribing_error_note])
            ->andFilterWhere(['like', 'administration_error_note', $this->administration_error_note])
            ->andFilterWhere(['like', 'dispensing_error_note', $this->dispensing_error_note])
            ->andFilterWhere(['like', 'pre_dispensing_laza', $this->pre_dispensing_laza])
            ->andFilterWhere(['like', 'pre_dispensing_man', $this->pre_dispensing_man])
            ->andFilterWhere(['like', 'pre_dispensing_check', $this->pre_dispensing_check])
            ->andFilterWhere(['like', 'wi', $this->wi])
            ->andFilterWhere(['like', 'wi_name', $this->wi_name])
            ->andFilterWhere(['like', 'sp', $this->sp])
            ->andFilterWhere(['like', 'sp_name', $this->sp_name])
            ->andFilterWhere(['like', 'cpg_cnpg', $this->cpg_cnpg])
            ->andFilterWhere(['like', 'cpg_cnpg_name', $this->cpg_cnpg_name])
            ->andFilterWhere(['like', 'effect', $this->effect])
            ->andFilterWhere(['like', 'lasa', $this->lasa]);

        return $dataProvider;
    }
}
