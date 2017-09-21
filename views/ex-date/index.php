<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
Yii::$app->formatter->locale = 'th_TH';

/* @var $this yii\web\View */
/* @var $searchModel risk\models\ExDateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ex Dates';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
Modal::begin([
  'id' => 'modal',
    'header' => '<h2>Hello world</h2>',
    'toggleButton' => ['label' => 'click me'],
]);
echo yii\bootstrap\Progress::widget([
    'percent' => 90,
    'barOptions' => ['class' => 'progress-bar-warning'],
    'options' => ['class' => 'progress-striped']
]);
Modal::end();
 ?>


<div class="ex-date-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'countries' ,'enablePushState' => false]) ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ex Date', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
              'attribute' => 'start',
              'value' => function($model) {
                return Yii::$app->formatter->asDate($model->start, 'long');
              },
            ],
            'end',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
<?php
$this->registerJs('
  $("#pjax-search-form").on("pjax:end", function() {
    $.pjax.reload({container:"#countries"});
  });
  $("#countries")
  .on("pjax:start", function() {
    $("#modal").modal("show");
   })
  .on("pjax:end",   function() {
    $("#modal").modal("hide");
  });
');
?>

<?php
// $js = <<< JS
// // $(function(){
// //   $('#modal').modal('show');
// // });
//
// JS;
//
// $this->registerJS($js);


 ?>
