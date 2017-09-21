<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\RmArticleCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
<div class="rm-article-category-view">
    <?= Html::button('แก้ไข', [
      'value' => Url::to(['/rm/rm-article-category/update',
      'id' => $model->id
    ]),
      'title' => 'แก้ไขหมวดหมู่'.$model->name,
      'class' => 'showModalButton btn btn-success glyphicon glyphicon-edit']); ?>
      <?php echo Html::submitButton('ปิด',['class' => 'btn btn-danger glyphicon glyphicon-off', 'data-dismiss'=>'modal']); ?>
</p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
<br>
