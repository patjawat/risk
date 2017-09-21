<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\AdministrationItems */

$this->title = 'Update Administration Items: ' . $model->administration_error_id;
$this->params['breadcrumbs'][] = ['label' => 'Administration Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->administration_error_id, 'url' => ['view', 'administration_error_id' => $model->administration_error_id, 'drug_items_id' => $model->drug_items_id, 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="administration-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
