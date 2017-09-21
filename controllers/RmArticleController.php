<?php

namespace risk\controllers;

use Yii;
use risk\models\RmArticle;
use risk\models\RmArticleSearch;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RmArticleController extends Controller
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
        $searchModel = new RmArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new RmArticle();

        if ($model->load(Yii::$app->request->post())) {

      $model->created_at = date('Y-m-d');
      $model->save();
      //return 'success';
      return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //  return $this->redirect(['view', 'id' => $model->id]);
            return 'success';
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionManual(){
      //  $searchModel = new RmArticleSearch();
      $dataProvider = new ArrayDataProvider([
        'allModels' => RmArticle::find()->where(['rm_article_category_id' =>'manual'])->all(),
        'sort' => [
          'attributes' => [ ]
           ]
       ]);
        return $this->render('_manual',[
          //'model' => $model,
          //'searchModel' =>   $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAll(){
      $searchModel = new RmArticleSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('all', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
    }
    protected function findModel($id)
    {
        if (($model = RmArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
