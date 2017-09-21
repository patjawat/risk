<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var risk\models\RmGroup $model
 */

$this->title = 'Update Rm Group: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'rm_workgroup_id' => $model->rm_workgroup_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
