<?php

namespace risk\controllers;

use Yii;
use risk\models\RmGroup;
use risk\models\RmGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RmGroupController implements the CRUD actions for RmGroup model.
 */
class RmGroupController extends Controller
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
     * Lists all RmGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RmGroupSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single RmGroup model.
     * @param string $id
     * @param string $rm_workgroup_id
     * @return mixed
     */
    public function actionView($id, $rm_workgroup_id)
    {
        $model = $this->findModel($id, $rm_workgroup_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    /**
     * Creates a new RmGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RmGroup;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'rm_workgroup_id' => $model->rm_workgroup_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RmGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param string $rm_workgroup_id
     * @return mixed
     */
    public function actionUpdate($id, $rm_workgroup_id)
    {
        $model = $this->findModel($id, $rm_workgroup_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'rm_workgroup_id' => $model->rm_workgroup_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RmGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @param string $rm_workgroup_id
     * @return mixed
     */
    public function actionDelete($id, $rm_workgroup_id)
    {
        $this->findModel($id, $rm_workgroup_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RmGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $rm_workgroup_id
     * @return RmGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $rm_workgroup_id)
    {
        if (($model = RmGroup::findOne(['id' => $id, 'rm_workgroup_id' => $rm_workgroup_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
