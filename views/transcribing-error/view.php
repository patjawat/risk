<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\TranscribingError */
?>
<div class="transcribing-error-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
