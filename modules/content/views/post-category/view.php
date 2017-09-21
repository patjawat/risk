<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\modules\content\models\PostCategory */
?>
<div class="post-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'post_id',
            'name',
        ],
    ]) ?>

</div>
