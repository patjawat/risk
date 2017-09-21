<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\ExDate */

$this->title = 'Create Ex Date';
$this->params['breadcrumbs'][] = ['label' => 'Ex Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ex-date-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'stringHash' => $stringHash,
    ]) ?>

</div>
