<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model risk\modules\profile\models\User */

$this->title = 'แก้ไขข้อมูลผู้ใช้งาน: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
        'profile' => $profile,
        'employee' => $employee
    ]) ?>

</div>
