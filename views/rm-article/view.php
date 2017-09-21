<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model risk\models\RmArticle */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rm Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  table th {
    width: 200px;
    text-align: right;

  }
  table.detail-view td {
    /*width: 10%;*/
  }

</style>
<div class="rm-article-view">
    <p>
        <?php Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php  Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
          แสดงเนื้อหาในหมวดหมู่  <code><?=$model->category->name;?></code>
          </div>
          <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'discription:html',

        ],
    ]) ?>
</div>
</div>
</div>
