<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\DrugItems */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Drug Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-items-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'generic_name',
        ],
    ]) ?>

</div>
