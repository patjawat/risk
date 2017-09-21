<?php

namespace risk\controllers;

use Yii;
use risk\models\TranscribingItems;
use risk\models\TranscribingItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;
use yii\helpers\Html;

class TranscribingItemsController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                  //  'delete-all' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TranscribingItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($transcribing_error_id, $drug_items_id, $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($transcribing_error_id, $drug_items_id, $id),
        ]);
    }

      public function actionCreate($id="")
    {
        $model = new TranscribingItems();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post())) {
          if ($model->authorities_id == "") {
            $model->authorities_id = NULL;
          }else {$model->authorities_id = json_encode($model->authorities_id);}
          if ($model->lasa == "") {
            $model->lasa = NULL;
          }else {$model->lasa = json_encode($model->lasa);}
          if(!$id ==""){
            $model->rm_event_id = $id;
          }
          $model->save();
          return [
            'forceReload' => '#transcribing-items',
              'title'=> "<span class='glyphicon glyphicon-plus'></span>เพิ่มความคลาดเคลื่อนในการสั่งใช้ยา",
              'content'=>  $this->renderAjax('create', ['model' => $model = new TranscribingItems(),'id' => $id]),
              'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
              Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
          ];
        } else {
          return [
              'title'=> "<span class='glyphicon glyphicon-plus'></span>เพิ่มความคลาดเคลื่อนในการสั่งใช้ยา",
              'content'=>  $this->renderAjax('create', ['model' => $model,'id' => $id]),
              'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
              Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
          ];
        }
    }


    public function actionUpdate($transcribing_error_id, $drug_items_id,$id)
    {
        $model = $this->findModel($transcribing_error_id, $drug_items_id,$id);
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post()) ) {
          if ($model->authorities_id == "") {
            $model->authorities_id = NULL;
          }else {$model->authorities_id = json_encode($model->authorities_id);}
          if ($model->lasa == "") {
            $model->lasa = NULL;
          }else {$model->lasa = json_encode($model->lasa);}
          $model->save();
          return [
            'forceReload' => '#transcribing-items',
              'title'=> "<span class='glyphicon glyphicon-plus'></span>แก้ไขความคลาดเคลื่อนในการสั่งใช้ยา",
              'content'=> $this->renderAjax('create', ['model' => new TranscribingItems(),'id' => $model->rm_event_id]),
              'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
              Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
          ];
            //return $this->redirect(['view', 'prescription_error_id' => $model->prescription_error_id, 'drug_items_id' => $model->drug_items_id]);
        } else {
          if ($model->authorities_id == "") {
            $model->authorities_id = NULL;
          }else {$model->authorities_id = json_decode($model->authorities_id);}
          if ($model->lasa == "") {
            $model->lasa = NULL;
          }else {$model->lasa = json_decode($model->lasa);}
            return [
              'forceReload' => '#transcribing-items',
                'title'=> "<span class='glyphicon glyphicon-plus'></span>แก้ไขความคลาดเคลื่อนในการสั่งใช้ยา",
                'content'=> $this->renderAjax('update', ['model' => $model,'id' => $model->rm_event_id]),
                'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
                Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
            ];
        }
    }

    public function actionDelete($transcribing_error_id, $drug_items_id, $id)
    {
        $this->findModel($transcribing_error_id, $drug_items_id, $id)->delete();

      //  return $this->redirect(['index']);
    }
    public function actionDeleteAll($id){
      $model = TranscribingItems::find()->where(['id' => $id])->one();
      $model->delete();
      return 'success';
}
    protected function findModel($transcribing_error_id, $drug_items_id, $id)
    {
        if (($model = TranscribingItems::findOne(['transcribing_error_id' => $transcribing_error_id, 'drug_items_id' => $drug_items_id, 'id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
