<?php

namespace risk\controllers;
use yii;
use risk\models\RmDepartment;
use risk\models\RmEvent;
use risk\models\RmItems;
use risk\models\RmGroup;


class DateController extends \yii\web\Controller
{
    public function actionIndex()
    {
    $model = new RmEvent();
    	$rm_items  = RmItems::find()->all();
    if ($model->load(Yii::$app->request->post()) ) {
           // $model->date1 = $model->date1;
    	Yii::$app->getSession()->setFlash('alert',[
                'body'=>'ประมวลผลเสร็จสิ้น',
                'options'=>['class'=>'alert-success']
            ]);

         }
      
    		return $this->render('index',[
					'rm_items' => $rm_items,
					'model' => $model
    			]);

    }






}
