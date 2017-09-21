<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use risk\models\RmArticleCategory;

$this->title = 'จัดการบทความ/เนื้อหา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-article-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('เขียนบทความ/เนื้อหา', ['create'], ['class' => 'btn btn-success fa fa-pencil-square-o']) ?>
    </p>
    <div class="ibox float-e-margins ui-sortable">
      <div class="ibox-title"><h5><span class="fa fa-newspaper-o"></span> แสดงรายการบทความและเนื้อหา</h5></div>
      <div class="ibox-content">
<?php Pjax::begin(); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'attribute'=>'rm_article_category_id',
              'vAlign'=>'middle',
              'width'=>'350px',
              'value'=>function ($model, $key, $index, $widget) {
                return $model->rm_article_category_id;
              },
              'filterType'=>GridView::FILTER_SELECT2,
              'filter'=>ArrayHelper::map(RmArticleCategory ::find()->all(), 'id', 'name'),
              'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
              ],
              'filterInputOptions'=>['placeholder'=>'--Select--'],
              'format'=>'raw'
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>
