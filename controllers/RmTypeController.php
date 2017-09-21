<?php

namespace risk\controllers;

use Yii;
use risk\models\RmType;
use risk\models\RmTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RmTypeController extends Controller
{
public $layout = 'setting';
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
     * Lists all RmType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RmTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
      if(Yii::$app->request->isAjax)
      {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
      }else {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
      }

    }


    public function actionCreate()
    {
        $model = new RmType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
          if(Yii::$app->request->isAjax)
          {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
          }else {
            return $this->render('create', [
                'model' => $model,
            ]);
          }

        }
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
          if(Yii::$app->request->isAjax)
          {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
          }else {
            return $this->render('update', [
                'model' => $model,
            ]);
          }

        }
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

      //  return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = RmType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
