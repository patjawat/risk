<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\DispensingItems */

$this->title = 'Create Dispensing Items';
$this->params['breadcrumbs'][] = ['label' => 'Dispensing Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispensing-items-create">
    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
