<?php

namespace risk\models;

class RmEventQuery extends \yii\db\ActiveQuery
{

    public function all($db = null)
    {
        return parent::all($db);
    }


    public function one($db = null)
    {
        return parent::one($db);
    }

    ############################# New

    public function test($id,$date1,$date2){
      return RmEvent::find()
      ->where(['rm_items_id' => $id])
      ->where("event_date between '".$date1 ."'and'".  $date2."'")
      ->count('id')*1;
    }
    public function Big($id)
     {
         return $this->andWhere(['rm_items_id' => $id]);
     }
     public function A($id)
      {

          return $this->andWhere(['rm_level_id' => $id]);
      }
}
