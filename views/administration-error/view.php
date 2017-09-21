<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\AdministrationError */
?>
<div class="administration-error-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
