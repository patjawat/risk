<?php

namespace risk\controllers;

use Yii;
use risk\models\MedEmployee;
use risk\models\MedEmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * MedEmployeeController implements the CRUD actions for MedEmployee model.
 */
class MedEmployeeController extends Controller
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
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MedEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MedEmployee model.
     * @param integer $id
     * @param integer $med_position_id
     * @return mixed
     */
    public function actionView($id, $med_position_id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "MedEmployee #".$id, $med_position_id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id, $med_position_id),
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::a('สร้างใหม่',['create'],['class'=>'btn btn-success','role'=>'modal-remote']).
                            Html::a('แก้ไข',['update','id' => $id,'med_position_id'=>$med_position_id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id, $med_position_id),
            ]);
        }
    }

    /**
     * Creates a new MedEmployee model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MedEmployee();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<i class='glyphicon glyphicon-pencil'></i>สร้างใหม่",
'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "<i class='glyphicon glyphicon-pencil'></i>สร้างใหม่",
'content'=>'<span class="text-success">Create MedEmployee success</span>',
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('สร้างใหม่',['create'],['class'=>'btn btn-success','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> "<i class='glyphicon glyphicon-pencil'></i>สร้างใหม่",
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
                return $this->redirect(['view', 'id' => $model->id, 'med_position_id' => $model->med_position_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    public function actionUpdate($id, $med_position_id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id, $med_position_id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "แก้ไข #".$id, $med_position_id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "MedEmployee #".$id, $med_position_id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::a('สร้างใหม่',['create'],['class'=>'btn btn-success','role'=>'modal-remote']).
                            Html::a('แก้ไข',['update','id' => $id,'med_position_id'=>$med_position_id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "แก้ไข #".$id, $med_position_id,
                    'content'=>$this->renderAjax('update', [
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
                return $this->redirect(['view', 'id' => $model->id, 'med_position_id' => $model->med_position_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing MedEmployee model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $med_position_id
     * @return mixed
     */
    public function actionDelete($id, $med_position_id)
    {
        $request = Yii::$app->request;
        $this->findModel($id, $med_position_id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing MedEmployee model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $med_position_id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the MedEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $med_position_id
     * @return MedEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $med_position_id)
    {
        if (($model = MedEmployee::findOne(['id' => $id, 'med_position_id' => $med_position_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
