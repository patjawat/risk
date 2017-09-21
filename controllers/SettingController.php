<?php

namespace risk\controllers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use risk\models\RmDepartment;
use risk\models\RmEvent;

class SettingController extends \yii\web\Controller
{

  //public $layout='setting';
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionTest(){
      $model = new RmEvent();
        return $this->render('test',[
          'model' => $model
        ]);
    }

    public function actionUser(){
        return $this->render('index');
    }






}
