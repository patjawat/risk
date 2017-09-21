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
use risk\models\RiskSystem;
use risk\modules\content\models\Blog;
use backend\modules\linenotify\models\LineBot;


class RiskController extends Controller
{

    public function actionIndex()
    {
      $searchModel = new RmEventSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $dataProvider->query->andFilterWhere(['editing_id' => 2]);
      $dataProvider->pagination->pageSize=5;
      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider
      ]);
    }

        public function actionView($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $rm_department_position_id, $department_id, $accident_id, $urgent_id, $editing_id)
    {

        return $this->render('@risk/views/rm-event/view', [

            'model' => $this->findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $rm_department_position_id, $department_id, $accident_id, $urgent_id, $editing_id),
        ]);
    }



    protected function findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $rm_department_position_id, $department_id, $accident_id, $urgent_id, $editing_id)
    {
        if (($model = RmEvent::findOne(['id' => $id, 'rm_level_id' => $rm_level_id, 'rm_levelgroup_id' => $rm_levelgroup_id, 'rm_items_id' => $rm_items_id, 'rm_group_id' => $rm_group_id, 'rm_workgroup_id' => $rm_workgroup_id, 'rm_type_id' => $rm_type_id, 'rm_reporttype_id' => $rm_reporttype_id, 'rm_department_position_id' => $rm_department_position_id, 'department_id' => $department_id, 'accident_id' => $accident_id, 'urgent_id' => $urgent_id, 'editing_id' => $editing_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionReview($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $rm_department_position_id, $department_id, $accident_id, $urgent_id, $editing_id)
    {
\Yii::$app->response->format = Response::FORMAT_JSON;
    $model = $this->findModel($id, $rm_level_id, $rm_levelgroup_id, $rm_items_id, $rm_group_id, $rm_workgroup_id, $rm_type_id, $rm_reporttype_id, $rm_department_position_id, $department_id, $accident_id, $urgent_id, $editing_id);
    // ตรวจสอบว่า user อยู่ในที่คล่อมที่เกี่ยวข้องหรือไม่
    $user =  AuthAssignment::find()
    ->where(['user_id' => Yii::$app->user->id,'item_name' => $model->rm_workgroup_id])
    ->all();
    if ($user==true) {
    $request = \Yii::$app->request;

  if ($model->load(Yii::$app->request->post())) {
    $model->review_date = date('Y-m-d');
    $model->save();
      //  return $this->redirect(['view', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'rm_department_position_id' => $model->rm_department_position_id, 'department_id' => $model->department_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id]);
      return [
        'forceReload' => '#pjax-container1',
          'title'=> "<span class='glyphicon glyphicon-refresh'></span>ทบทวนเหตุการณ์ความเสี่ยง",
          'content'=> '<h1 class="text-center"><span class="glyphicon glyphicon-ok" style="color:green;"></span>บันทึกสำเร็จ</h1>',
          //'content'=> $id, // for example: $this->renderAjax('view', [
          'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
          Html::a('แก้ไข', ['review', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'rm_department_position_id' => $model->rm_department_position_id, 'department_id' => $model->department_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id],
          ['class' => 'btn btn-warning glyphicon glyphicon-refresh','role' => 'modal' ])
      ];
  }else {
    return [
    //   'forceReload' => '#pjax-container1',
        'title'=> "<span class='glyphicon glyphicon-refresh'></span>ทบทวนเหตุการณ์ความเสี่ยง",
        'content'=> $this->renderAjax('review',['model' => $model]),
        //'content'=> $id, // for example: $this->renderAjax('view', [
        'footer'=> Html::button('Close',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"]).
        Html::button('บันทึก',['class'=>'btn btn-primary','type'=>"submit"])
    ];
  }
  }else {
    return [
    //   'forceReload' => '#pjax-container1',
        'title'=> "<span class='glyphicon glyphicon-refresh'></span>ทบทวนเหตุการณ์ความเสี่ยง",
        'content'=> '<h1 class="text-center">ความเสี่ยงนี้ไม่ใช่อยู่ในกลุ่มงานที่คุณรับผิดชอบ</h2>',
        //'content'=> $id, // for example: $this->renderAjax('view', [
        'footer'=> Html::button('ปิด',['class'=>'btn btn-danger pull-left glyphicon glyphicon-off','data-dismiss'=>"modal"])
    ];
  }
    }

    public function actionAbout(){

      $model = RiskSystem::find()->where(['id' => 'abount'])->one();
      return $this->render('about',
      [  'model' => $model  ]
    );
    }

    public function actionViewBlog($id, $blog_category_id)
    {
      if (($model = Blog::findOne(['id' => $id, 'blog_category_id' => $blog_category_id])) !== null) {
        return $this->render('view_blog', [
            'model' => $model,
        ]);
      } else {
          throw new NotFoundHttpException('The requested page does not exist.');
      }

    }
    public function actionViewAll()
    {
    return $this->render('view_all');

    }

    public function actionLine()
    {
        $request = Yii::$app->request;
$model = LineBot::findOne('risk');

            if ($model->load($request->post()) && $model->save()) {
               Yii::$app->session->setFlash('success', 'บันทึกข้อมูลสำเร็จ');
              return $this->render('@backend/modules/linenotify/views/line-bot/update', [
                  'model' => $model,
              ]);
            } else {

                return $this->render('@backend/modules/linenotify/views/line-bot/update', [
                    'model' => $model,
                ]);
            }
        }



}
