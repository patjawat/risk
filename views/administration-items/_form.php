<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use risk\models\AdministrationError;
use risk\models\DrugItems;
use risk\models\Authorities;
?>
<style media="screen">
.modal.stick-up .modal-dialog {
  margin: -5px auto;
  width: 65%;
}
</style>
<?php $form = ActiveForm::begin([
'fieldConfig' => [
    'horizontalCssClasses' => [
        'label' => 'col-md-4',
        'offset' => 'col-md-offset-3',
        'wrapper' => 'col-md-6'
    ]
],
'layout' => 'horizontal'
]); ?>
<?= $form->field($model, 'rm_event_id')->hiddenInput(['value' => $id])->label(false); ?>
<?php
echo $form->field($model, 'administration_error_id', [
  ])->widget(Select2::classname(), [
    'data' => ArrayHelper::map(AdministrationError::find()->all(),'id', 'name'),
    'language' => 'th',
    'options' => [
      'placeholder' => '--- เลือก ---',
    ],
    'pluginOptions' => [
      'allowClear' => true
    ],
  ]);
  ?>
  <?php
  echo $form->field($model, 'drug_items_id', [
    ])->widget(Select2::classname(), [
      'data' => ArrayHelper::map(DrugItems::find()->all(),'id', 'generic_name'),
      'language' => 'th',
      'options' => [
        'placeholder' => '--- เลือก ---',
        'id' => 'drug_items_id1',
      ],
      'pluginOptions' => [
        'allowClear' => true
      ],
    ]);
    ?>

  <?php
  // Normal select with ActiveForm & model
  echo   $form->field($model, 'authorities_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Authorities::find()->all(),'id','name'),
    'language' => 'th',
    'options' => ['placeholder' => '--- เลือก ---'],
    'pluginOptions' => [
      'allowClear' => true,
      'multiple' => true
    ],
  ]);
  ?>
  <?php
  echo $form->field($model, 'med_employee_id', [
    ])->widget(Select2::classname(), [
      'data' => ArrayHelper::map(risk\models\MedEmployee::find()->all(),'id', 'name'),
      'language' => 'th',
      'options' => [
        'placeholder' => '--- เลือก ---',
        'id' => 'med_employee_id',
      ],
      'pluginOptions' => [
        'allowClear' => true
      ],
    ]);
    ?>
    <?= $form->field($model, 'details')->textarea(['rows' => 4]) ?>
  <?php echo $form->field($model, 'lasa')->checkBoxList(['label' => 'lasa']);  ?>
  <?php ActiveForm::end(); ?>
