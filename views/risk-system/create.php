<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model risk\models\RiskSystem */

$this->title = 'เพิ่มเนื้อหาเกี่ยวกับระบบ';
$this->params['breadcrumbs'][] = ['label' => 'Risk Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-system-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
