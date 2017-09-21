<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\modules\content\models\Blog */

$this->title = 'สร้างบทความ';
$this->params['breadcrumbs'][] = ['label' => 'บทความ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
