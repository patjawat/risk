<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\AdministrationItems */

$this->title = 'Create Administration Items';
$this->params['breadcrumbs'][] = ['label' => 'Administration Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administration-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
