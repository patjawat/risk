<?php

namespace risk\controllers;

use Yii;
use risk\models\RmLevel;
use risk\models\RmLevelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RmLevelController implements the CRUD actions for RmLevel model.
 */
class RmLevelController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RmLevel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RmLevelSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single RmLevel model.
     * @param string $id
     * @param string $rm_levelgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionView($id, $rm_levelgroup_id, $rm_type_id)
    {
        $model = $this->findModel($id, $rm_levelgroup_id, $rm_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    /**
     * Creates a new RmLevel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RmLevel;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_type_id' => $model->rm_type_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RmLevel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $rm_levelgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionUpdate($id, $rm_levelgroup_id, $rm_type_id)
    {
        $model = $this->findModel($id, $rm_levelgroup_id, $rm_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_type_id' => $model->rm_type_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RmLevel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $rm_levelgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionDelete($id, $rm_levelgroup_id, $rm_type_id)
    {
        $this->findModel($id, $rm_levelgroup_id, $rm_type_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RmLevel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $rm_levelgroup_id
     * @param string $rm_type_id
     * @return RmLevel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $rm_levelgroup_id, $rm_type_id)
    {
        if (($model = RmLevel::findOne(['id' => $id, 'rm_levelgroup_id' => $rm_levelgroup_id, 'rm_type_id' => $rm_type_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
