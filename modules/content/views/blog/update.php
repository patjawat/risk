<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\modules\content\models\Blog */

$this->title = 'แก้ไข: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
