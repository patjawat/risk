<?php

namespace risk\controllers;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use risk\models\RmEvent;
use risk\models\RmEventSearch;

class WorkController extends \yii\web\Controller
{
    public function actionIndex()
    {
      // GridView Data
      $model = new RmEvent();
     $query  = RmEvent::find()
     ->where(['check_date' => NULL,'review_date' => NULL])
     ->orwhere(['review_date' => NULL])
     ->All();
     $dataProvider = new ArrayDataProvider([
       'allModels' => $query ,
       'sort' => [
         'attributes' => [ ]
          ]
      ]);
      //End

      return $this->render('index', [
          'dataProvider' => $dataProvider,
          'model' => $model,
      ]);
    }

    public function actionCheck($id){
      $date = date('Y-m-d H:m:s');
      // Yii::$app->db->createCommand()->update('rm_event', ['check_date' => $date])->where(['id' => $id])->execute();
      Yii::$app->risk->createCommand('UPDATE rm_event SET check_date="'.$date.'" WHERE id='.$id.'')
 ->execute();

return $this->redirect(['index']);
  //return "<h2 class='text-center'>ตรวจรับแล้ว</h2>";


    }

}
