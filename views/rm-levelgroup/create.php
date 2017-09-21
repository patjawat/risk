<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\RmLevelgroup */

$this->title = 'ระดับความรุนแรง';
$this->params['breadcrumbs'][] = ['label' => 'ระดับความรุนแรง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-levelgroup-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
