<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\Ex1 */

$this->title = 'Create Ex1';
$this->params['breadcrumbs'][] = ['label' => 'Ex1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ex1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
