<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\modules\profile\models\User */

$this->title = 'เพิ่มข้อมูลผู้เข้าใช้งานระบบ';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
        'profile' => $profile,
        'employee' => $employee
    ]) ?>

</div>
