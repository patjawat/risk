<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\RmEvent */

$this->title = 'แก้ไขอุบัติการณ์ความเสี่ยงเลขที่: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rm Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'rm_department_position_id' => $model->rm_department_position_id, 'department_id' => $model->department_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rm-event-update">
    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=> $initialPreview,
        'initialPreviewConfig'=> $initialPreviewConfig,
        'transcribingitems' => $transcribingitems
    ]) ?>


</div>
