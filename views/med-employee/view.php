<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\MedEmployee */
?>
<div class="med-employee-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'med_position_id',
        ],
    ]) ?>

</div>
