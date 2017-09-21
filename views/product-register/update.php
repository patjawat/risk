<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var risk\modules\em\models\ProductRegister $model
 */

$this->title = 'Update Product Register: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'product_items_id' => $model->product_items_id, 'product_items_category_id' => $model->product_items_category_id, 'department_id' => $model->department_id, 'dealer_id' => $model->dealer_id, 'band_id' => $model->band_id, 'status_id' => $model->status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-register-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
