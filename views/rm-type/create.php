<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\RmType */

$this->title = 'ประเภท';
$this->params['breadcrumbs'][] = ['label' => 'ประเภท', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
