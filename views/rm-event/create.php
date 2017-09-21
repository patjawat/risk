<?php

use yii\helpers\Html;
// Yii::$app->session->setFlash('success', 'This is the message');

$this->title = 'อุบัติการณ์ความเสี่ยง';
$this->params['breadcrumbs'][] = ['label' => 'Rm Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rm-event-create">
    <?= $this->render('_form', [
      'model' => $model,
      'initialPreview'=> [],
      'initialPreviewConfig'=> [],

    ]) ?>

</div>
