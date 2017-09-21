<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var risk\models\RmWorkgroup $model
 */

$this->title = 'Update Rm Workgroup: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Workgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-workgroup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
