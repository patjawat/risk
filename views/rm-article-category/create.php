<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\RmArticleCategory */

$this->title = 'หมวดหมู่เนื้อหา';
$this->params['breadcrumbs'][] = ['label' => 'Rm Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-article-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
