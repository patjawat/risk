<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\PrescriptionError */
?>
<div class="prescription-error-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
