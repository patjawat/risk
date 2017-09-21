<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\RmItems */
?>
<div class="rm-items-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rm_group_id',
            'rm_workgroup_id',
            'rm_type_id',
            'name',
            'specific_clinical_id',
        ],
    ]) ?>

</div>
