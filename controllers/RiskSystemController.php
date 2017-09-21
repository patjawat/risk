<?php

namespace risk\controllers;

use Yii;
use risk\models\RiskSystem;
use risk\models\RiskSystemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RiskSystemController implements the CRUD actions for RiskSystem model.
 */
class RiskSystemController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionUpload()
    {
        $uploadedFile = UploadedFile::getInstanceByName('upload');
        $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
        $file = time()."_".$uploadedFile->name;

        $user_id = Yii::$app->user->getId();

        $url = Yii::$app->urlManager->createAbsoluteUrl('/uploads/'.$user_id.'/'.$file);
        $uploadPath = Yii::getAlias('@webroot').'/uploads/'.$user_id.'/'.$file;

        if (!is_dir(Yii::getAlias('@webroot').'/uploads/'.$user_id)) { //ถ้ายังไม่มี folder ให้สร้าง folder ตาม user id
            mkdir(Yii::getAlias('@webroot').'/uploads/'.$user_id);
        }

        //ตรวจสอบ
        if ($uploadedFile==null)
        {
            $message = "ไม่มีไฟล์ที่ Upload";
        }
        else if ($uploadedFile->size == 0)
        {
            $message = "ไฟล์มีขนาด 0";
        }
        else if ($mime!="image/jpeg" && $mime!="image/png" && $mime != "image/gif")
        {
            $message = "รูปภาพควรเป็น JPG หรือ PNG";
        }
        else if ($uploadedFile->tempName==null)
        {
            $message = "มีข้อผิดพลาด";
        }
        else {
            $message = "";
            $move = $uploadedFile->saveAs($uploadPath);
            if(!$move)
            {
                $message = "ไม่สามารถนำไฟล์ไปไว้ใน Folder ได้กรุณาตรวจสอบ Permission Read/Write/Modify";
            }
        }
        $funcNum = $_GET['CKEditorFuncNum'] ;
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }

    /**
     * Lists all RiskSystem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RiskSystemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RiskSystem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RiskSystem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RiskSystem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RiskSystem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RiskSystem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RiskSystem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RiskSystem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RiskSystem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
