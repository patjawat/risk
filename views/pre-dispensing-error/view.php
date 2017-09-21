<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\PreDispensingError */
?>
<div class="pre-dispensing-error-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
