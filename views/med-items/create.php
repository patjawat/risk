<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\MedItems */

$this->title = 'Create Med Items';
$this->params['breadcrumbs'][] = ['label' => 'Med Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="med-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
