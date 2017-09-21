<?php

namespace risk\controllers;

class AboutController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionVersion(){
      return $this->render('version');
    }
    public function actionManual(){
      return $this->render('manual');
    }

}
