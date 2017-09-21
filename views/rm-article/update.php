<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\RmArticle */

$this->title = 'แก้ไข: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-article-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
