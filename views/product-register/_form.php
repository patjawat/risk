<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var risk\modules\em\models\ProductRegister $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="product-register-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รหัส...']],

            'product_items_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ครุภัณฑ์...']],

            'product_items_category_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter หมวดหมู่...']],

            'code' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter   รหัสครุภัณฑ์...', 'maxlength' => 45]],

            'department_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter แผนก/ฝ่าย...', 'maxlength' => 10]],

            'dealer_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ผู้จำหน่าย...']],

            'band_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ยี่ห้อ...']],

            'model' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รุ่น...', 'maxlength' => 45]],

            'status_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Status ID...', 'maxlength' => 5]],

            'price' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ราคา...']],

            'user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ผู้บันทึก...', 'maxlength' => 45]],

            'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ชื่อ...', 'maxlength' => 45]],

            'date_start' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รับเข้า...', 'maxlength' => 45]],

            'date_expire' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter หมดอายุ...', 'maxlength' => 45]],

            'budgets_year' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ปีงบประมาณ...', 'maxlength' => 4]],

            'photo' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter รูปภาพ...', 'maxlength' => 255]],

        ]

    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
    );
    ActiveForm::end(); ?>

</div>
