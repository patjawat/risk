<?php

namespace risk\modules\profile\controllers;

use Yii;
use risk\modules\profile\models\User;
use risk\modules\profile\models\UserSearch;
use risk\modules\profile\models\Profile;
use risk\modules\profile\models\Employee;
use risk\modules\profile\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;
use yii\helpers\Html;

class UserController extends Controller

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
    $searchModel = new UserSearch();
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

// เพิ่มผู้ใช้งาน
  public function actionCreate()
  {
    $model = new User();
    $profile = new Profile();
    $employee = new Employee();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      //บันทึกตาราง user
      $model->setPassword($model->password);
      $model->generateAuthKey();
      $model->confirmed_at = time();
      $model->save();

      $employee->load(Yii::$app->request->post());
      $profile->user_id = $model->id;
      $profile->name = $employee->name;

      $profile->save();
      $employee->user_id = $model->id;

      $employee->save();
      Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
        return $this->redirect(['index']);
      //return $this->redirect(['view', 'id' => $model->id]);
    }else {
      if(Yii::$app->request->isAjax){
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [
          'title'=> '<h1><span class="fa fa-user-circle-o"></span> เพิ่มข้อมูลผู้เข้าใช้งานระบบ</h1>',
          'content'=> $this->renderAjax('create', [
            'model' => $model,
            'profile' => $profile,
            'employee' => $employee]),
            'footer'=> Html::button('<span class="fa fa-close"></span>ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
            Html::button('<span class="fa fa-check-square-o"></span>บันทึก',['class'=>'btn  btn-primary','type'=>"submit"])
          ];
        }else {
          return $this->render('create', [
            'model' => $model,
            'profile' => $profile,
            'employee' => $employee]);
          }
        }
      }

// สมัครสมาชิก
      public function actionRegister()
      {

        $model = new User();
        $profile = new Profile();
        $employee = new Employee();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            //บันทึกตาราง user
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $model->confirmed_at = time();
            $model->save();

            $employee->load(Yii::$app->request->post());
            $profile->user_id = $model->id;
            $profile->name = $employee->name;

            $profile->save();
            $employee->user_id = $model->id;

            $employee->save();
            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย รอการอนุมัติจากผู้ดูแลระบบ');
            return $this->redirect(['/']);


          //return $this->redirect(['view', 'id' => $model->id]);
        }else {
          if(Yii::$app->request->isAjax){
            $request = \Yii::$app->request;
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return [
              'title'=> '<h1><span class="fa fa-user-circle-o"></span> เพิ่มข้อมูลผู้เข้าใช้งานระบบ</h1>',
              'content'=> $this->renderAjax('create', [
                'model' => $model,
                'profile' => $profile,
                'employee' => $employee]),
                'footer'=> Html::button('<span class="fa fa-close"></span>ปิด',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('<span class="fa fa-check-square-o"></span>บันทึก',['class'=>'btn  btn-primary','type'=>"submit"])
              ];
            }else {
              return $this->render('register', [
                'model' => $model,
                'profile' => $profile,
                'employee' => $employee]);
              }
            }
          }


      public function actionUpdate($id)
      {
        $model = $this->findModel($id);
        $profile = Profile::find()->where(['user_id' => $id])->one();
        if(Employee::find()->where(['user_id' => $id])->one()){
          $employee = Employee::find()->where(['user_id' => $id])->one();
          $employee->items_id = json_encode(AuthAssignment::find()->all());
        }else {
          $employee = new Employee();
        }
        $model->password = $model->password_hash;
        if ($model->load(Yii::$app->request->post())) {
          if($model->password_hash!=$model->password ){
            $model->setPassword($model->password);
          }
          $model->save();
          $employee->load(Yii::$app->request->post());
          $employee->user_id = $model->id;
          $profile->name = $employee->name;
          $profile->save();

          $employee->save();
          Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
          return $this->redirect(Yii::$app->request->referrer);
            // return $this->redirect(['index']);
          //return $this->redirect(['view', 'id' => $model->id]);
        } else {
          return $this->render('update', [
            'model' => $model,
            'profile' => $profile,
            'employee' => $employee
          ]);
        }
      }

      public function actionBlock($id)
      {
        if ($id == \Yii::$app->user->getId()) {
          \Yii::$app->getSession()->setFlash('danger', \Yii::t('user', 'You can not block your own account'));
        } else {
          $user  = $this->findModel($id);
          $event = $this->getUserEvent($user);
          if ($user->getIsBlocked()) {
            $this->trigger(self::EVENT_BEFORE_UNBLOCK, $event);
            $user->unblock();
            $this->trigger(self::EVENT_AFTER_UNBLOCK, $event);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been unblocked'));
          } else {
            $this->trigger(self::EVENT_BEFORE_BLOCK, $event);
            $user->block();
            $this->trigger(self::EVENT_AFTER_BLOCK, $event);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been blocked'));
          }
        }

        //        return $this->redirect(Url::previous('actions-redirect'));
      }

      public function actionDelete($id)
      {
        $employee = Employee::deleteAll(['user_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
      }

      protected function findModel($id)
      {
        if (($model = User::findOne($id)) !== null) {
          return $model;
        } else {
          throw new NotFoundHttpException('The requested page does not exist.');
        }
      }

    }
