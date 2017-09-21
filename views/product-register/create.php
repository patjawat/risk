<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var risk\modules\em\models\ProductRegister $model
 */

$this->title = 'Create Product Register';
$this->params['breadcrumbs'][] = ['label' => 'Product Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-register-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
