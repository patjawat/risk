<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var risk\models\RmLevel $model
 */

$this->title = 'Update Rm Level: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_type_id' => $model->rm_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
