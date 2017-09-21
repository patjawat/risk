<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var risk\modules\em\models\ProductRegister $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-register-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'id',
            'product_items_id',
            'product_items_category_id',
            'code',
            'department_id',
            'user_id',
            'dealer_id',
            'band_id',
            'model',
            'name',
            'date_start',
            'date_expire',
            'budgets_year',
            'photo',
            'status_id',
            'price',
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->id],
        ],
        'enableEditMode' => true,
    ]) ?>

</div>
