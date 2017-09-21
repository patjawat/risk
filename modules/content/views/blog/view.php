<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\modules\content\models\Blog */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">
<style media="screen">
table.detail-view th {
      width: 10%;
}

table.detail-view td {
      width: 90%;
}
</style>
    <?php \yiister\adminlte\widgets\Box::begin(
               [
                   "header" => $model->name,
                   "icon" => "comment",
                   "type" => \yiister\adminlte\widgets\Box::TYPE_PRIMARY,
                   "removable" => true,
               ]
           )?>
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-edit"></i> แก้ไข', ['update', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i> ลบข้อมูล', ['delete', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title_image',
            'name',
            'content:html',
            'user_id',
            'create_at',
            'update_at',
            'blog_category_id',
            'status',
            'ref',
        ],
    ]) ?>
<?php \yiister\adminlte\widgets\Box::end() ?>
</div>
