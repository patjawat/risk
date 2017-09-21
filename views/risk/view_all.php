<?php
use yii\helpers\Html;
use yii\helpers\Url;
use risk\modules\content\models\Blog;
 ?>
 <?php \yiister\adminlte\widgets\Box::begin(
            [
                "header" => "ความรู้เกี่ยวกับความเสี่ยง",
                "icon" => "tasks",
                "type" => \yiister\adminlte\widgets\Box::TYPE_PRIMARY,
                "removable" => true,
            ]
        )?>
<ul class="products-list product-list-in-box">
  <?php foreach (Blog::find()->where(['blog_category_id' => 'risk'])->all() as $model): ?>
  <li class="item">
    <div class="product-img">
      <img src="http://placehold.it/130x130" class="img-thumbnail" alt="Product Image">
    </div>
    <div class="product-info">
      <?=Html::a($model->name, ['view-blog', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id], ['class' => '']);?>
          <span class="product-description">
                <code><i class="fa fa-user" aria-hidden="true"></i></code><?=$model->user->username;?>
              </span>
    </div>
  </li>
  <?php endforeach; ?>
  <!-- /.item -->
</ul>
<?php \yiister\adminlte\widgets\Box::end() ?>
