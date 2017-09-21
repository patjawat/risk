<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\PrescriptionItems */

$this->title = 'Create Prescription Items';
$this->params['breadcrumbs'][] = ['label' => 'Prescription Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prescription-items-create">
    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
