<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\MedError */

$this->title = 'Create Med Error';
$this->params['breadcrumbs'][] = ['label' => 'Med Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="med-error-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
