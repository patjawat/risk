<?php

namespace risk\controllers;

use Yii;
use risk\models\PrescriptionItems;
use risk\models\PrescriptionItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;
use yii\helpers\Html;

/**
 * PrescriptionItemsController implements the CRUD actions for PrescriptionItems model.
 */
class PrescriptionItemsController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new PrescriptionItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($prescription_error_id, $drug_items_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($prescription_error_id, $drug_items_id),
        ]);
    }

    public function actionCreate($id="")
    {
        $model = new PrescriptionItems();
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
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
            'forceReload' => '#pjax-container',
              'title'=> "<span class='glyphicon glyphicon-plus'></span>เพิ่มความคลาดเคลื่อนในการสั่งใช้ยา",
              'content'=>  $this->renderAjax('create', ['model' => new PrescriptionItems(),'id' => $id]),
              'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
              Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
          ];
          // return "success";
          //  return $this->redirect(['view', 'prescription_error_id' => $model->prescription_error_id, 'drug_items_id' => $model->drug_items_id]);
        } else {
          return [
              'title'=> "<span class='glyphicon glyphicon-plus'></span>เพิ่มความคลาดเคลื่อนในการสั่งใช้ยา",
              'content'=>  $this->renderAjax('create', ['model' => $model,'id' => $id]),
              'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
              Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
          ];
        }
    }


    public function actionUpdate($prescription_error_id, $drug_items_id)
    {
        $model = $this->findModel($prescription_error_id, $drug_items_id);
        $request = \Yii::$app->request;
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
            'forceReload' => '#pjax-container',
              'title'=> "<span class='glyphicon glyphicon-plus'></span>แก้ไขความคลาดเคลื่อนในการสั่งใช้ยา",
              'content'=> $this->renderAjax('create', ['model' => new PrescriptionItems(),'id' => $model->rm_event_id]),
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
              'forceReload' => '#pjax-container',
                'title'=> "<span class='glyphicon glyphicon-plus'></span>แก้ไขความคลาดเคลื่อนในการสั่งใช้ยา",
                'content'=> $this->renderAjax('update', ['model' => $model,'id' => $model->rm_event_id]),
                'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
                Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
            ];
        }
    }

    public function actionDelete($prescription_error_id, $drug_items_id)
    {
        $this->findModel($prescription_error_id, $drug_items_id)->delete();

      //  return $this->redirect(['index']);
    }

     public function actionDeleteAll($id){
       $model = PrescriptionItems::find()->where(['id' => $id])->one();
       $model->delete();
       return 'success';

 }
    protected function findModel($prescription_error_id, $drug_items_id)
    {
        if (($model = PrescriptionItems::findOne(['prescription_error_id' => $prescription_error_id, 'drug_items_id' => $drug_items_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
