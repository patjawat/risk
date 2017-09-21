<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\DrugItems */

$this->title = 'Create Drug Items';
$this->params['breadcrumbs'][] = ['label' => 'Drug Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-items-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
