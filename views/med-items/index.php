<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use risk\models\MedType;
$this->title = 'Med Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="med-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Med Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'attribute' => 'med_type_id',
              'value' => function($model) {
                return $model->medType->name;
              },
              'header' => 'ประเภท',
              'filter' => ArrayHelper::map(MedType::find()->asArray()->all(), 'id', 'name'),
              // 'vAlign' => 'middle',
              'width' => '25%',
              'filterType' => GridView::FILTER_SELECT2,
              'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
              ],
              //'headerOptions' => ['class' => 'text-center'],
              'contentOptions' => ['class' => 'text-center'],
              'filterInputOptions' => ['placeholder' => 'เลือกข้อมูล'],
            ],
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
