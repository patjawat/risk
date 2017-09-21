<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\RmArticleCategory */

$this->title = 'Update Rm Article Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-article-category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
