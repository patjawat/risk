<?php

namespace risk\controllers;

use Yii;
use risk\models\DrugItems;
use risk\models\DrugItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;


/**
 * DrugItemsController implements the CRUD actions for DrugItems model.
 */
class DrugItemsController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all DrugItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DrugItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
      $request = \Yii::$app->request;
      \Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title'=> "<span class='glyphicon glyphicon-eye-open'></span>แสดงชื่อรายการยา",
            'content'=> $this->renderAjax('view',['model' => $this->findModel($id),]),
            'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal" ,"id" => "close"]).
            Html::a('เพิ่ม', ['/drug-items/create'],
            ['class' => 'btn btn-success glyphicon glyphicon-plus','role' => 'modal' ]).
            Html::a('แก้ไข', ['/drug-items/update','id' => $id],
            ['class' => 'btn btn-warning glyphicon glyphicon-edit','role' => 'modal' ])
        ];
    }

    public function actionCreate()
    {
        $model = new DrugItems();
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return [
            'forceReload' => '#pjax-container',
              'title'=> "<span class='glyphicon glyphicon-eye-open'></span>แสดงชื่อรายการยา
",
              'content'=> $this->renderAjax('view',['model' => $this->findModel($model->id),]),
              'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal" ,"id" => "close"]).
              Html::a('เพิ่ม', ['/drug-items/create'],
              ['class' => 'btn btn-success glyphicon glyphicon-plus','role' => 'modal' ]).
              Html::a('แก้ไข', ['/drug-items/update','id' => $model->id],
              ['class' => 'btn btn-warning glyphicon glyphicon-edit','role' => 'modal' ])
          ];
             //  return $this->redirect(['view', 'id' => $model->id]);
           } else {
             return [
                 'title'=> "<span class='glyphicon glyphicon-plus'></span>เพิ่มรายการยา
",
                 'content'=>  $this->renderAjax('create', ['model' => $model]),
                 'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
                 Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
             ];
           }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return [
            'forceReload' => '#pjax-container',
              'title'=> "<span class='glyphicon glyphicon-eye-open'></span>แสดงชื่อรายการยา
",
              'content'=> $this->renderAjax('view',['model' => $this->findModel($model->id),]),
              'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal" ,"id" => "close"]).
              Html::a('เพิ่ม', ['/drug-items/create'],
              ['class' => 'btn btn-success glyphicon glyphicon-plus','role' => 'modal' ]).
              Html::a('แก้ไข', ['/drug-items/update','id' => $model->id],
              ['class' => 'btn btn-warning glyphicon glyphicon-edit','role' => 'modal' ])
          ];
              //return $this->redirect(['view', 'id' => $model->id]);
          } else {
            return [
                'title'=> "<span class='glyphicon glyphicon-edit'></span>แก้ไขรายการยา
",
                'content'=>  $this->renderAjax('update', ['model' => $model]),
                'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
                Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
            ];

          }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DrugItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DrugItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DrugItems::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
