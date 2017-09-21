<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use cenotia\components\modal\RemoteModal;
use risk\models\RmWorkgroup;

$this->title = 'โปรแกรมความเสี่ยง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-group-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Rm Group', ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'attribute' => 'rm_workgroup_id',
              'value' => function($model) {
                return $model->rmWorkgroup->name;
              },
              'filter' => ArrayHelper::map(RmWorkgroup::find()->asArray()->all(), 'id', 'name'),
                  // 'vAlign' => 'middle',
                   'width' => '15%',
                 'filterType' => GridView::FILTER_SELECT2,
                 'filterWidgetOptions' => [
                     'pluginOptions' => ['allowClear' => true],
                 ],
                 //'headerOptions' => ['class' => 'text-center'],
                // 'contentOptions' => ['class' => 'text-center'],
                 'filterInputOptions' => ['placeholder' => '-- เลือก --'],
              ],
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Yii::$app->urlManager->createUrl(['rm/rm-group/view', 'id' => $model->id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'edit' => 't']),
                            ['title' => Yii::t('yii', 'Edit'),]
                        );
                    }
                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,

        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> แสดงรายการ'.Html::encode($this->title).' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่ม', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]); Pjax::end(); ?>

</div>
