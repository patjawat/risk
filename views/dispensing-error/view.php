<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\DispensingError */
?>
<div class="dispensing-error-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
