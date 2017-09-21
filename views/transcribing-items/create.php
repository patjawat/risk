<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\TranscribingItems */

$this->title = 'Create Transcribing Items';
$this->params['breadcrumbs'][] = ['label' => 'Transcribing Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transcribing-items-create">
    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
