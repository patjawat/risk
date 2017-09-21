<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\MedItems */

$this->title = 'Update Med Items: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Med Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="med-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
