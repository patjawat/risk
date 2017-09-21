<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\modules\content\models\BlogCategory */
?>
<div class="blog-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
