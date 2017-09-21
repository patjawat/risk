<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\models\MedError */

$this->title = 'Update Med Error: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Med Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="med-error-update">
    <?php
  echo $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
