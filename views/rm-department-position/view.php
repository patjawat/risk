<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\RmDepartmentPosition */
?>
<div class="rm-department-position-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'department_id',
        ],
    ]) ?>

</div>
