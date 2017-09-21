<?php

namespace risk\controllers;

use Yii;
use risk\models\RmLevelgroup;
use risk\models\RmLevelgroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RmLevelgroupController extends Controller
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


    public function actionIndex()
    {
        $searchModel = new RmLevelgroupSearch();
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
        $model = new RmLevelgroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //  return $this->redirect(['view', 'id' => $model->id]);
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
        if (($model = RmLevelgroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
