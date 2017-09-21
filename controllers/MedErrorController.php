<?php

namespace risk\controllers;

use Yii;
use risk\models\MedError;
use risk\models\MedItems;
use risk\models\MedErrorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;
use yii\web\Response;
use yii\helpers\Html;
use kartik\dialog\Dialog;
use risk\models\Cart;

class MedErrorController extends Controller
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
        $searchModel = new MedErrorSearch();
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

    public function actionCreate($id=null)
    {
        $model = new MedError();
        $model->rm_event_id = $id;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post())) {
          //$model->rm_event_id = $model->rm_event_id;
          $model->med_items_id = $model->name;

          $model->save();
            return [
              'forceReload' => '#pjax-container',
                'title'=> "<span class='glyphicon glyphicon-edit'></span>การประมวลผล",
                'content'=> '<h1 class="text-center"><span class="glyphicon glyphicon-ok" style="color:green;"></span>บันทึกสำเร็จ</h1>',//$this->renderAjax('create',['model' => $model]),
                //'footer'=> Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
                'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal" ,"id" => "close"]).
                Html::a('เพิ่ม', ['/med-error/create','id' => $id],
                ['class' => 'btn btn-success glyphicon glyphicon-plus','role' => 'modal' ])
            ];
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
          return [
          //  'forceReload' => '#pjax-container',
              'title'=> "<span class='glyphicon glyphicon-edit'></span>ความคลาดเคลื่อนทางยา",
              'content'=> $this->renderAjax('create',['model' => $model ]),
              'footer'=> Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
          ];
            // return $this->render('create', [
            //     'model' => $model,
            // ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(Yii::$app->request->referrer);
          // return [
          //     'forceReload' => '#pjax-container',
          //     'title'=> "<span class='glyphicon glyphicon-eye-open'></span>แสดงชื่อโปรแกรมความเสี่ยง",
          //     'content'=> "บันทึกสำเร็จ",//$this->renderAjax('update',['model' => $this->findModel($id)]),
          //     'footer'=> Html::button('แก้ไข',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
          // ];
          //  return $this->redirect(['view', 'id' => $model->id]);
        } else {
          return [
          //  'forceReload' => '#pjax-rmgroup',
              'title'=> "<span class='glyphicon glyphicon-eye-open'></span>แสดงชื่อโปรแกรมความเสี่ยง",
              'content'=> $this->renderAjax('update',['model' => $model]),
            'footer'=> Html::button('แก้ไข',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])


          ];
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

      //  return $this->redirect(['index']);
    }


    public function actionAddItems(){
      $model = new MedItems();
      $model->rm_event_id = null;
      $request = \Yii::$app->request;
      \Yii::$app->response->format = Response::FORMAT_JSON;

      if ($model->load(Yii::$app->request->post())) {
        $cart = new Cart();
        $data = array(
            'id' => $model->name.$model->med_items_id.$model->med_type_id.$model->med_employee_id,
            'qty' => 1,
            'price' => 1,
            'med_type_id' => $model->med_type_id,
            'med_items_id' => $model->name,
            'med_employee_id' => $model->med_employee_id,
            'note' => $model->note,
            'lasa' => $model->lasa,
            'name' => 1
                //'options' => array('Size' => 'L', 'Color' => 'Red')
        );
        $cart->insert($data);
        return [
          'forceReload' => '#pjax-container',
            'title'=> "<span class='glyphicon glyphicon-plus'></span>ความคลาดเคลื่อนทางยา",
            'content'=> '<h1 class="text-center"><span class="glyphicon glyphicon-ok" style="color:green;"></span>บันทึกสำเร็จ</h1>',//$this->renderAjax('create', ['model' => $model]),//$this->renderAjax('AddItems',['model' => $model]),
            // 'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
            // Html::button('Add item',['class'=>'btn btn-default','type'=>"submit"])
            'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal" ,"id" => "close"]).
            Html::a('เพิ่ม', ['/med-error/add-items'],
            ['class' => 'btn btn-success glyphicon glyphicon-plus','role' => 'modal' ])
        ];
        //  return $this->redirect(['view', 'id' => $model->id, 'rm_group_id' => $model->rm_group_id, 'rm_type_id' => $model->rm_type_id]);
      } else {
        return [
        //  'forceReload' => '#pjax-container',
            'title'=> "<span class='glyphicon glyphicon-plus'></span>ความคลาดเคลื่อนทางยา",
            'content'=>  $this->renderAjax('create', ['model' => $model]),
            'footer'=> Html::button('บันทึก',['class'=>'btn btn-primary glyphicon glyphicon-floppy-saved','type'=>"submit"])
        ];
      }
    }

   public function actionDelItems($id){
     $request = \Yii::$app->request;
     \Yii::$app->response->format = Response::FORMAT_JSON;
     $cart = new Cart();
     $cart->remove($id);
     return [
       'forceReload' => '#pjax-container',
         'title'=> "<span class='glyphicon glyphicon-plus'></span>ความคลาดเคลื่อนทางยา",
         'content'=> '',//$this->renderAjax('create', ['model' => $model]),//$this->renderAjax('AddItems',['model' => $model]),
         'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
         Html::button('Add item',['class'=>'btn btn-default','type'=>"submit"])
     ];
   }

    protected function findModel($id)
    {
        if (($model = MedError::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
