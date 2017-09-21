<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\RmLevelgroup */

$this->title = 'ระดับความรุนแรง: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Levelgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-levelgroup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
