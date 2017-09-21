<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\modules\content\models\Blog */

$this->title = "บทความ";
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'content:html',

        ],
    ]) ?>
<?php \yiister\adminlte\widgets\Box::end() ?>
