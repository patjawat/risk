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
     * Lists all RmItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RmItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single RmItems model.
     * @param integer $id
     * @param string $rm_group_id
     * @param string $rm_workgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionView($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "แสดงรายการที่ #".$id, $rm_group_id, $rm_workgroup_id, $rm_type_id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id),
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('แก้ไข',['update','id' => $model->id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $model
            ]);
        }
    }

    /**
     * Creates a new RmItems model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
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
'content'=>'<span class="text-success">บันทึกสำเร็จ</span>',
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

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
                return $this->redirect(['view', 'id' => $model->id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
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
                    'title'=> "<i class='glyphicon glyphicon-pencil'></i>สร้างใหม่",
'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#items-datatable-pjax',
                    'title'=> "<i class='glyphicon glyphicon-pencil'></i>สร้างใหม่",
'content'=>'<span class="text-success">บันทึกสำเร็จ</span>',
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('สร้างใหม่',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

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
                return $this->redirect(['view', 'id' => $model->id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing RmItems model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $rm_group_id
     * @param string $rm_workgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionUpdate($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "<i class='glyphicon glyphicon-edit'></i>แก้ไขรายการที่ #".$id, $rm_group_id, $rm_workgroup_id, $rm_type_id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "แสดงรายการที่ #".$id, $rm_group_id, $rm_workgroup_id, $rm_type_id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('แก้ไข',['update','id, $rm_group_id, $rm_workgroup_id, $rm_type_id'=>$id, $rm_group_id, $rm_workgroup_id, $rm_type_id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "<i class='glyphicon glyphicon-edit'></i>แก้ไขรายการที่ #".$id, $rm_group_id, $rm_workgroup_id, $rm_type_id,
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
                return $this->redirect(['view', 'id' => $model->id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing RmItems model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $rm_group_id
     * @param string $rm_workgroup_id
     * @param string $rm_type_id
     * @return mixed
     */
    public function actionDelete($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)
    {
        $request = Yii::$app->request;
        $this->findModel($id, $rm_group_id, $rm_workgroup_id, $rm_type_id)->delete();

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
     * Delete multiple existing RmItems model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $rm_group_id
     * @param string $rm_workgroup_id
     * @param string $rm_type_id
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
