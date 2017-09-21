<?php

namespace risk\modules\content\controllers;

use Yii;
use risk\modules\content\models\Blog;
use risk\modules\content\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
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

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @param string $blog_category_id
     * @return mixed
     */
    public function actionView($id, $blog_category_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $blog_category_id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
        if ($model->load(Yii::$app->request->post()) ) {
          $model->create_at = date('Y-m-d');
          $model->user_id = Yii::$app->user->id;
        //$this->Uploads(false);

        if($model->save()){
             return $this->redirect(['view', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id]);
        }

    } else {
         $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
    }

    return $this->render('create', [
        'model' => $model,
    ]);
    }


    public function actionUpdate($id, $blog_category_id)
    {
        $model = $this->findModel($id, $blog_category_id);

        if ($model->load(Yii::$app->request->post())) {
          $model->update_at = date('Y-m-d');
          $model->save();
            return $this->redirect(['view', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $blog_category_id
     * @return mixed
     */
    public function actionDelete($id, $blog_category_id)
    {
        $this->findModel($id, $blog_category_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $blog_category_id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $blog_category_id)
    {
        if (($model = Blog::findOne(['id' => $id, 'blog_category_id' => $blog_category_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
