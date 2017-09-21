<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel risk\models\RiskSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เกี่ยวกับระบบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-system-index">
    <?php
        \yiister\adminlte\widgets\Box::begin(
            [
                "header" => Html::encode($this->title),
                'icon' => 'code',
                "type" => \yiister\adminlte\widgets\Box::TYPE_DANGER,
                "collapsable" => true,
            ]
        )
        ?>
<?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> สร้าง', ['create'], ['class' => 'btn btn-success']) ?>
<?php Pjax::begin(); ?>
<?= \yiister\adminlte\widgets\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        "condensed" => true,
       "hover" => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php \yiister\adminlte\widgets\Box::end() ?>
</div>
