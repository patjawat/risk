<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use risk\models\RmArticleCategory;

$this->title = 'ระบบค้นหาบทความ-เนื้อหา';
$this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
.action-column {
  width: 10px;
}
</style>

<div class="rm-article-index">

  <h3 class="glyphicon glyphicon-search"><?= Html::encode($this->title) ?></h3>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
              //['class' => 'yii\grid\SerialColumn'],
              [

                'attribute' => 'rm_article_category_id',
                'value' => function($model) {
                  return $model->category->name;
                },
                'header' => 'ประเภท',
                'filter' => ArrayHelper::map(RmArticleCategory::find()->asArray()->all(), 'id', 'name'),
                // 'vAlign' => 'middle',
                'width' => '180px',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                  'pluginOptions' => ['allowClear' => true],
                ],
                //'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'filterInputOptions' => ['placeholder' => 'เลือกข้อมูล'],
              ],

              [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($model) {
                    return $model->name;
                },
                //'header' => 'ประเภท',
                // 'vAlign' => 'middle',
                'width' => '600px',

              ],
              ['class' => 'yii\grid\ActionColumn', 'buttons' => [
                // 'view' => function ($url, $model, $key) {
                //     return Html::button('',
                //       ['value' => $url,
                //       'title' => 'กลุ่มอุบัติการความเสี่ยง : '.$model->name,
                //       'class' => 'showModalButton btn btn-sm btn-primary glyphicon glyphicon-play'
                //     ]);
                // },
                'view' => function ($url, $model, $key) {
                  return Html::button('',
                  ['value' => $url,
                  'title' => 'ชื่อเนื้อหา : '.$model->name,
                  'class' => 'showModalButton btn btn-sm btn-primary glyphicon glyphicon-play'
                ]);
              },
              'update' => function ($url, $model, $key) {},
            'delete' => function ($url) {},

          ]
        ],
          ],
      ]); ?>
