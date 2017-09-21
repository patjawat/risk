<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\RmArticle */

$this->title = 'เขียนบทความ/เนื้อหา';
$this->params['breadcrumbs'][] = ['label' => 'นบทความ/เนื้อหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-article-create">
    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
