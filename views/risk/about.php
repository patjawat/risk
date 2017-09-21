<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->params['breadcrumbs'][] = ['label' => 'Med Errors', 'url' => ['index']];
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
                "header" => Html::encode($model->name),
                "type" => \yiister\adminlte\widgets\Box::TYPE_SUCCESS,
                "removable" => true,
                'icon' => 'comment'
            ]
        )
        ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'content:html'
        ],
    ]) ?>
      <?php \yiister\adminlte\widgets\Box::end() ?>
