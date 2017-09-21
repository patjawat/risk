<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel risk\models\AdministrationItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administration Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administration-items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Administration Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'administration_error_id',
            'drug_items_id',
            'details',
            'lasa:ntext',
            'rm_event_id',
            // 'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
