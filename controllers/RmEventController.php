<?php

namespace risk\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use risk\models\RmEvent;
use risk\models\RmEventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\bootstrap\Modal;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\ArrayHelper;
use risk\models\RmGroup;
use risk\models\RmItems;
use risk\models\RmLevel;
use risk\models\Year;
use risk\models\RmDepartmentPosition;
use risk\models\RmEventHasLeveleffect;
use risk\models\Cart;
use common\models\User;
use risk\models\Uploads;
use risk\models\Model;
use risk\models\TranscribingItems;
use risk\models\TranscribingItemsSearch;
use risk\models\MedError;
use risk\models\MedItems;
use risk\models\AuthAssignment;
use backend\modules\linenotify\models\LineBot;
class RmEventController extends Controller
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
        $searchModel = new RmEventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->innerJoinWith('rmLevelgroup', 'rm_event.rm_levelgroup_id = rm_levelgroup.id');
        $dataProvider->query->andFilterWhere(['between', 'date(event_date)', $searchModel->date1,$searchModel->date2]);
        $dataProvider->pagination->pageSize=5;

        $querys = RmEvent::find();
        $querys->select('rm_levelgroup.name as name,count(rm_event.id) as total,rm_event.*');
        $querys->innerJoinWith('rmLevelgroup', 'rm_event.rm_levelgroup_id = rm_levelgroup.id');
        $querys->groupby('rm_levelgroup.id');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id,$accident_id, $urgent_id, $editing_id)
    {

        return $this->render('view', [

            'model' => $this->findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id,$accident_id, $urgent_id, $editing_id),
        ]);
    }


        public function actionCreate()
        {
            $model = new RmEvent();
            $carts = new Cart();
            $modelstranscribing = [new TranscribingItems];

            if ($model->load(Yii::$app->request->post())) {
                $this->Uploads(false);
                $group = RmItems::findOne($model->rm_items_id)->rm_group_id;
                $model->rm_group_id = $group;
                $model->editing_id = "2";
                $model->report_date = date('Y-m-d H:i:s'); // วันที่รายงาน
                $model->rm_workgroup_id = RmGroup::findOne($group)->rm_workgroup_id;
                $model->rm_levelgroup_id = RmLevel::findOne($model->rm_level_id)->rm_levelgroup_id;
                $model->rm_type_id = RmItems::findOne($model->rm_items_id)->rm_type_id;
                $model->reporter =  Yii::$app->user->identity->id;
                $model->related = json_encode($model->related);
                $model->effect = json_encode($model->effect);
                if ($model->administration_error == "") {
                  $model->administration_error = NULL;
                }else {$model->administration_error = json_encode($model->administration_error);}
                if ($model->administration_laza == "") {
                  $model->administration_laza = NULL;
                }else {$model->administration_laza = json_encode($model->administration_laza);}
                // ความคลาดเคลื่อนในการสั่งใช้ยา (Prescription Error)
                if ($model->prescription_error == "") {
                  $model->prescription_error = NULL;
                }else {$model->prescription_error = json_encode($model->prescription_error);}
                if ($model->prescription_laza == "") {
                  $model->prescription_laza = NULL;
                }else {$model->prescription_laza = json_encode($model->prescription_laza);}

                if ($model->pre_dispensing_error == "") {
                  $model->pre_dispensing_error = NULL;
                }else {$model->pre_dispensing_error = json_encode($model->pre_dispensing_error);}
                if ($model->pre_dispensing_laza == "") {
                  $model->pre_dispensing_laza = NULL;
                }else {$model->pre_dispensing_laza = json_encode($model->pre_dispensing_laza);}
                // ความคลาดเคลื่อนในการคัดลอกคำสั่งใช้ยา (Transcribing Error)
                if ($model->transcribing_error == "") {
                  $model->transcribing_error = NULL;
                }else {$model->transcribing_error = json_encode($model->transcribing_error);}
                if ($model->transcribing_laza == "") {
                  $model->transcribing_laza = NULL;
                }else {$model->transcribing_laza = json_encode($model->transcribing_laza);}
                // ความคลาดเคลื่อนในการจ่ายยา (Dispensing Error)
                if ($model->dispensing_error == "") {
                  $model->dispensing_error = NULL;
                }else {$model->dispensing_error = json_encode($model->dispensing_error);}
                if ($model->dispensing_laza == "") {
                  $model->dispensing_laza = NULL;
                }else {$model->dispensing_laza = json_encode($model->dispensing_laza);}
                  //$this->Uploads(false);
                 if($model->save()){
                   foreach ($carts->contents() as $cart) {
                      $med = new MedError;
                        $med->rm_event_id = $model['id'];
                        $med->med_employee_id = $cart['med_employee_id'];
                        $med->med_type_id = $cart['med_type_id'];
                        $med->med_items_id = $cart['med_items_id'];
                        $med->note = $cart['note'];
                        $med->lasa = $cart['lasa'];
                        $med->save();
                   }
                   $carts->destroy();
                  //  แจ้งเตือนผ่าน Line
                  $message = 'พบความเสี่ยง :: '.RmItems::findOne($model->rm_items_id)->name.'    ระดับความเสี่ยง ::[ '.
                  RmLevel::findOne($model->rm_level_id)->id.' ]';
                  if ($this->sendline($message)) {
                    # code...
                   Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
                   return $this->redirect(['view', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'rm_department_position_id' => $model->rm_department_position_id, 'department_id' => $model->department_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id]);
                 }
                 }
                //  MedError

            } else {
              $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
               return $this->render('create', [
                   'model' => $model,

               ]);
            }
        }

    public function actionUpdate($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $accident_id, $urgent_id, $editing_id)
    {

        $model = $this->findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $accident_id, $urgent_id, $editing_id);
        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);
        if (Yii::$app->user->identity->id == $model->reporter) {
        if ($model->load(Yii::$app->request->post())) {
          $model->rm_workgroup_id = RmGroup::findOne($model->rm_group_id)->rm_workgroup_id;
                 $model->rm_levelgroup_id = RmLevel::findOne($model->rm_level_id)->rm_levelgroup_id;
                 $model->rm_type_id = RmItems::findOne($model->rm_items_id)->rm_type_id;
                 $model->related = json_encode($model->related);
                 $model->effect = json_encode($model->effect);
                 // ความคลาดเคลื่อนในการบริหารยา (Administration Error)
                        if ($model->administration_error == "") {
                          $model->administration_error = NULL;
                        }else {$model->administration_error = json_encode($model->administration_error);}
                        if ($model->administration_laza == "") {
                          $model->administration_laza = NULL;
                        }else {$model->administration_laza = json_encode($model->administration_laza);}
                        // ความคลาดเคลื่อนในการสั่งใช้ยา (Prescription Error)
                        if ($model->prescription_error == "") {
                          $model->prescription_error = NULL;
                        }else {$model->prescription_error = json_encode($model->prescription_error);}
                        if ($model->prescription_laza == "") {
                          $model->prescription_laza = NULL;
                        }else {$model->prescription_laza = json_encode($model->prescription_laza);}

                        if ($model->pre_dispensing_error == "") {
                          $model->pre_dispensing_error = NULL;
                        }else {$model->pre_dispensing_error = json_encode($model->pre_dispensing_error);}
                        if ($model->pre_dispensing_laza == "") {
                          $model->pre_dispensing_laza = NULL;
                        }else {$model->pre_dispensing_laza = json_encode($model->pre_dispensing_laza);}
                        // ความคลาดเคลื่อนในการคัดลอกคำสั่งใช้ยา (Transcribing Error)
                        if ($model->transcribing_error == "") {
                          $model->transcribing_error = NULL;
                        }else {$model->transcribing_error = json_encode($model->transcribing_error);}
                        if ($model->transcribing_laza == "") {
                          $model->transcribing_laza = NULL;
                        }else {$model->transcribing_laza = json_encode($model->transcribing_laza);}
                        // ความคลาดเคลื่อนในการจ่ายยา (Dispensing Error)
                        if ($model->dispensing_error == "") {
                          $model->dispensing_error = NULL;
                        }else {$model->dispensing_error = json_encode($model->dispensing_error);}
                        if ($model->dispensing_laza == "") {
                          $model->dispensing_laza = NULL;
                        }else {$model->dispensing_laza = json_encode($model->dispensing_laza);}
                        $this->Uploads(false);

        $model->save();
        Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
        return $this->redirect(['view', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'rm_department_position_id' => $model->rm_department_position_id, 'department_id' => $model->department_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id]);
        } else {
          $model->related = json_decode($model->related);
          $model->effect = json_decode($model->effect);
        //ผลกระทบ
          $model->prescription_error = json_decode($model->prescription_error);
          $model->prescription_laza = json_decode($model->prescription_laza);

          $model->pre_dispensing_error = json_decode($model->pre_dispensing_error);
          $model->pre_dispensing_laza = json_decode($model->pre_dispensing_laza);

          $model->transcribing_error = json_decode($model->transcribing_error);
          $model->transcribing_laza = json_decode($model->transcribing_laza);

          $model->administration_error = json_decode($model->administration_error);
          $model->administration_laza = json_decode($model->administration_laza);

          $model->dispensing_error = json_decode($model->dispensing_error);
          $model->dispensing_laza = json_decode($model->dispensing_laza);

          $transcribingitems = new TranscribingItems();

            # code...

            return $this->render('update', [
                'model' => $model,
                'transcribingitems' => $transcribingitems,
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig'=>$initialPreviewConfig,

            ]);

          }
        }else {
        throw new \yii\web\NotFoundHttpException("ไม่สามารถแก้ไขข้อมูลส่วนส่วนนี้เนื้อจากไม่ใช่ข้อมูลในส่วนของคุณบันทึก");

         //$exception = new \yii\web\HttpException(500);
      //  return \Yii::$app->errorHandler->errorAction = '/rm/default/error';
        }
    }




    public function actionDelete($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $accident_id, $urgent_id, $editing_id)
    {
        $model = RmEvent::findOne(['id' => $id]);
      if (Yii::$app->user->identity->id == $model->reporter) {
        $this->findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $accident_id, $urgent_id, $editing_id)->delete();
        return $this->redirect(['index']);
      } else {
            throw new \yii\web\NotFoundHttpException('ไม่สามารถลบได้เนื่องจากคุณไม่ใช่เจ้าของข้อมูลนี้ !!');
        }
    }

    protected function findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id,$accident_id, $urgent_id, $editing_id)
    {
        if (($model = RmEvent::findOne(['id' => $id, 'rm_level_id' => $rm_level_id, 'rm_levelgroup_id' => $rm_levelgroup_id, 'rm_items_id' => $rm_items_id, 'rm_group_id' => $rm_group_id, 'rm_workgroup_id' => $rm_workgroup_id, 'rm_type_id' => $rm_type_id, 'rm_reporttype_id' => $rm_reporttype_id,'accident_id' => $accident_id, 'urgent_id' => $urgent_id, 'editing_id' => $editing_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionReview($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id,$accident_id, $urgent_id, $editing_id)
    {
\Yii::$app->response->format = Response::FORMAT_JSON;
    $model = $this->findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id,$accident_id, $urgent_id, $editing_id);
    // ตรวจสอบว่า user อยู่ในที่คล่อมที่เกี่ยวข้องหรือไม่
    // $user =  AuthAssignment::find()
    // ->where(['user_id' => Yii::$app->user->id,'item_name' => $model->rm_workgroup_id])
    // ->all();
    // if ($user==true) {
    // $request = \Yii::$app->request;

  if ($model->load(Yii::$app->request->post())) {
    $model->review_date = date('Y-m-d');
    $model->save();
      return $this->redirect(['index']);
      //  return $this->redirect(['view', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'rm_department_position_id' => $model->rm_department_position_id, 'department_id' => $model->department_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id]);
      // return [
      //   'forceReload' => '#pjax-container',
      //     'title'=> "<span class='glyphicon glyphicon-refresh'></span>ทบทวนเหตุการณ์ความเสี่ยง",
      //     'content'=> '<h1 class="text-center"><span class="glyphicon glyphicon-ok" style="color:green;"></span>บันทึกสำเร็จ</h1>',
      //     //'content'=> $id, // for example: $this->renderAjax('view', [
      //     'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
      //     Html::a('แก้ไข', ['review', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'rm_department_position_id' => $model->rm_department_position_id, 'department_id' => $model->department_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id],
      //     ['class' => 'btn btn-warning glyphicon glyphicon-refresh','role' => 'modal' ])
      // ];
  }else {
    return [
      'forceReload' => '#pjax-container',
        'title'=> "<span class='glyphicon glyphicon-refresh'></span>ทบทวนเหตุการณ์ความเสี่ยง",
        'content'=> $this->renderAjax('review',['model' => $model]),
        //'content'=> $id, // for example: $this->renderAjax('view', [
        'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
        Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
    ];
  }
  // }else {
  //   return [
  //     'forceReload' => '#pjax-container',
  //       'title'=> "<span class='glyphicon glyphicon-refresh'></span>ทบทวนเหตุการณ์ความเสี่ยง",
  //       'content'=> '<h1 class="text-center">ความเสี่ยงนี้ไม่ใช่อยู่ในกลุ่มงานที่คุณรับผิดชอบ</h2>',
  //       //'content'=> $id, // for example: $this->renderAjax('view', [
  //       'footer'=> Html::button('ปิด',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"])
  //   ];
  // }




  }
    public function actionDepartmentPosition() {
              $out = [];
              if (isset($_POST['depdrop_parents'])) {
                $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                  $cat_id = $parents[0];
                  $out = RmDepartmentPosition::find()->where(['department_id' => $cat_id])->all();
                  echo Json::encode(['output' => $out, 'selected' => '']);
                  return;
                }
              }
              echo Json::encode(['output' => '', 'selected' => '']);
            }

            public function actionLevel() {
                  $out = [];
                  if (isset($_POST['depdrop_parents'])) {
                    $parents = $_POST['depdrop_parents'];
                    $items = RmItems::findOne(['id' => $parents]);

                    //echo $parents[1];
                    if ($parents != null) {
                      $cat_id = $parents[0];
                      $out = RmLevel::find()->where(['rm_type_id' => $items->rm_type_id])->all();
                    echo Json::encode(['output' => $out, 'selected' => '']);
                      return;
                    }
                  }
                  echo Json::encode(['output' => '', 'selected' => '']);
                }
                public function actionItems() {
                      $out = [];
                      if (isset($_POST['depdrop_parents'])) {
                        $parents = $_POST['depdrop_parents'];
                        if ($parents != null) {
                          $cat_id = $parents[0];
                          $out = RmItems::find()->where(['rm_group_id' => $cat_id])->all();
                          echo Json::encode(['output' => $out, 'selected' => '']);
                          return;
                        }
                      }
                      echo Json::encode(['output' => '', 'selected' => '']);
                    }

                    public function actionCheckmed($id){
                      $key = ['Administration','dispensing','prescribing'];
                      $model = RmItems::find()->where(['id' => $id])
                      ->andwhere(['in', 'specific_clinical_id', $key])->count();
                      return $model;
                    }

                /*|*********************************************************************************|
                |================================ Upload Ajax ====================================|
                |*********************************************************************************|*/

                public function actionUploadAjax(){
                  $this->Uploads(true);
                }

                private function CreateDir($folderName){
                  if($folderName != NULL){
                    $basePath = RmEvent::getUploadPath();
                    if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                      BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
                    }
                  }
                  return;
                }

                private function removeUploadDir($dir){
                  BaseFileHelper::removeDirectory(RmEvent::getUploadPath().$dir);
                }

                private function Uploads($isAjax=false) {
                  if (Yii::$app->request->isPost) {
                    $images = UploadedFile::getInstancesByName('upload_ajax');
                    if ($images) {

                      if($isAjax===true){
                        $ref =Yii::$app->request->post('ref');
                      }else{
                        $RmEvent = Yii::$app->request->post('RmEvent');
                        $ref = $RmEvent['ref'];
                      }

                      $this->CreateDir($ref);

                      foreach ($images as $file){
                        $fileName       = $file->baseName . '.' . $file->extension;
                        $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                        $savePath       = RmEvent::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                        if($file->saveAs($savePath)){

                          if($this->isImage(Url::base(true).'/'.$savePath)){
                            $this->createThumbnail($ref,$realFileName);
                          }

                          $model                  = new Uploads;
                          $model->ref             = $ref;
                          $model->file_name       = $fileName;
                          $model->real_filename   = $realFileName;
                          $model->save();

                          if($isAjax===true){
                            echo json_encode(['success' => 'true']);
                          }

                        }else{
                          if($isAjax===true){
                            echo json_encode(['success'=>'false','eror'=>$file->error]);
                          }
                        }

                      }
                    }
                  }
                }

                private function getInitialPreview($ref) {
                  $datas = Uploads::find()->where(['ref'=>$ref])->all();
                  $initialPreview = [];
                  $initialPreviewConfig = [];
                  foreach ($datas as $key => $value) {
                    array_push($initialPreview, $this->getTemplatePreview($value));
                    array_push($initialPreviewConfig, [
                      'caption'=> $value->file_name,
                      'width'  => '120px',
                      'url'    => Url::to(['deletefile-ajax']),
                      'key'    => $value->upload_id
                    ]);
                  }
                  return  [$initialPreview,$initialPreviewConfig];
                }

                public function isImage($filePath){
                  return @is_array(getimagesize($filePath)) ? true : false;
                }

                private function getTemplatePreview(Uploads $model){
                  $filePath = RmEvent::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
                  $isImage  = $this->isImage($filePath);
                  if($isImage){
                    $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                  }else{
                    $file =  "<div class='file-preview-other'> " .
                    "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                    "</div>";
                  }
                  return $file;
                }

                private function createThumbnail($folderName,$fileName,$width=250){
                  $uploadPath   = RmEvent::getUploadPath().'/'.$folderName.'/';
                  $file         = $uploadPath.$fileName;
                  $image        = Yii::$app->image->load($file);
                  $image->resize($width);
                  $image->save($uploadPath.'thumbnail/'.$fileName);
                  return;
                }

                public function actionDeletefileAjax(){

                  $model = Uploads::findOne(Yii::$app->request->post('key'));
                  if($model!==NULL){
                    $filename  = RmEvent::getUploadPath().$model->ref.'/'.$model->real_filename;
                    $thumbnail = RmEvent::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
                    if($model->delete()){
                      @unlink($filename);
                      @unlink($thumbnail);
                      echo json_encode(['success'=>true]);
                    }else{
                      echo json_encode(['success'=>false]);
                    }
                  }else{
                    echo json_encode(['success'=>false]);
                  }
                }

                private function uploadSingleFile($model,$tempFile=null){
                  $file = [];
                  $json = '';
                  try {
                    $UploadedFile = UploadedFile::getInstance($model,'photo_title');
                    if($UploadedFile !== null){
                      $oldFileName = $UploadedFile->basename.'.'.$UploadedFile->extension;
                      $newFileName = md5($UploadedFile->basename.time()).'.'.$UploadedFile->extension;
                      $UploadedFile->saveAs(RmEvent::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                      $file[$newFileName] = $oldFileName;
                      $json = Json::encode($file);
                    }else{
                      $json=$tempFile;
                    }
                  } catch (Exception $e) {
                    $json=$tempFile;
                  }
                  return $json ;
                }

                private function uploadMultipleFile($model,$tempFile=null){
                  $files = [];
                  $json = '';
                  $tempFile = Json::decode($tempFile);
                  $UploadedFiles = UploadedFile::getInstances($model,'docs');
                  if($UploadedFiles!==null){
                    foreach ($UploadedFiles as $file) {
                      try {   $oldFileName = $file->basename.'.'.$file->extension;
                        $newFileName = md5($file->basename.time()).'.'.$file->extension;
                        $file->saveAs(RmEvent::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                        $files[$newFileName] = $oldFileName ;
                      } catch (Exception $e) {

                      }
                    }
                    $json = json::encode(ArrayHelper::merge($tempFile,$files));
                  }else{
                    $json = $tempFile;
                  }
                  return $json;
                }
                public function actionViewCheck($id){

                  $model = RmEvent::findOne(['id' => $id]);
                  return $this->renderAjax('view_check',[
                    'model' => $model
                  ]);
                  }



          public function actionDelitem($id) {
              $cart = new Cart();
              $cart->remove($id);
              return $this->redirect(['/rm/rm-event/create']);
          }

          public function actionCheck(){
            //$model = new MedItems();
          //  return $this->render('AddItems',['model' => $model]);
        }

          // แจ้งเตือนผ่าน Line
          public function sendline($message){
            $id = 'risk';
            $line_token = LineBot::findOne($id)->token;

            $chOne = curl_init();
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            // SSL USE
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
            //POST
            curl_setopt( $chOne, CURLOPT_POST, 1);
            // Message
            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$message");
            //ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
            //curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$mms&imageThumbnail=http://plusquotes.com/images/quotes-img/surprise-happy-birthday-gifts-5.jpg&imageFullsize=http://plusquotes.com/images/quotes-img/surprise-happy-birthday-gifts-5.jpg&stickerPackageId=1&stickerId=100");
            // follow redirects
            curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
            //ADD header array
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$line_token.'', );
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            //RETURN
            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec( $chOne );
            //Check error
            if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
            else { $result_ = json_decode($result, true);
            //echo "status : ".$result_['status']; echo "message : ". $result_['message'];
            return true;
           }
            //Close connect
            curl_close( $chOne );

          }


  }
