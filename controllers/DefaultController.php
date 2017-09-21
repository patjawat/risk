<?php

namespace risk\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use risk\models\RmEvent;
use risk\models\RmEventSearch;

class DefaultController extends Controller
{

    public function actionIndex()
    {
      $searchModel = new RmEventSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $dataProvider->query->andFilterWhere(['editing_id' => 2]);
      $dataProvider->pagination->pageSize=5;
      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider
      ]);
    }
    public function actionDateTime()
    {
        $time = time();
         return '<span class=" glyphicon glyphicon-folder-close"></span> วันที่ '.date('d-m-Y').' เวลา '.date('H:i:s');
        // return \Yii::$app->formatter->asDateTime($time, 'php:Y-m-d H:i:s');
    }
    public function actionError(){
      //echo "Error";
      if(Yii::$app->request->isAjax)
      {
          return $this->renderAjax('@frontend/modules/rm/views/admintle/site/error');
      }else {
      return $this->render('@frontend/modules/rm/views/admintle/site/error');
      }

    }
}
