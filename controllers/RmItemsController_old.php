<?php

namespace risk\controllers;

use Yii;
use risk\models\RmItems;
use risk\models\RmItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * RmItemsController implements the CRUD actions for RmItems model.
 */
class RmItemsController extends Controller
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
     * Lists all RmItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RmItemsSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    public function actionView($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)
    {
        $model = $this->findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    public function actionCreate()
    {
        $model = new RmItems;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateSetting()
    {
        $request = Yii::$app->request;
        $model = new RmItems();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "เพิ่มรายการความเสี่ยง",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#items-datatable-pjax',
                    'title'=> "เพิ่มแผนก/ฝ่าย",
                    'content'=>'<span class="text-success">บันทึกสำเร็จ</span>',
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['/rm-items/create-setting'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "เพิ่มแผนก/ฝ่าย",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->department_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing RmItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $rm_group_id
     * @param string $rm_workgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionUpdate($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)
    {
        $model = $this->findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RmItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $rm_group_id
     * @param string $rm_workgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionDelete($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)
    {
        $this->findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RmItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $rm_group_id
     * @param string $rm_workgroup_id
     * @param string $rm_type_id
     * @return RmItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)
    {
        if (($model = RmItems::findOne(['id' => $id, 'rm_group_id' => $rm_group_id, 'rm_workgroup_id' => $rm_workgroup_id, 'rm_type_id' => $rm_type_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
