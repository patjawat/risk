<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\MedType */

$this->title = 'Create Med Type';
$this->params['breadcrumbs'][] = ['label' => 'Med Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="med-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
