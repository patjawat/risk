<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use risk\models\PrescriptionError;
use risk\models\DrugItems;
use risk\models\Authorities;
use risk\models\MedEmplayee;
?>


  <?php $form = ActiveForm::begin([
    'action' => 'index.php?r=rm/prescription-items/create',
    'id' => 'prescription-items',
  'fieldConfig' => [
      'horizontalCssClasses' => [
          'label' => 'col-md-4',
          'offset' => 'col-md-offset-3',
          'wrapper' => 'col-md-6'
      ]
  ],
  'layout' => 'horizontal'
  ]); ?>
<h1>333</h1>
<?php
//$rm_event_id = 1;
 ?>
    <?= $form->field($model, 'rm_event_id')->hiddenInput(['value' => $rm_event_id])->label(false); ?>
<div class="row">
  <div class="col-md-6">
    <?php
    echo $form->field($model, 'prescription_error_id', [
      ])->widget(Select2::classname(), [
        'data' => ArrayHelper::map(PrescriptionError::find()->all(),'id', 'name'),
        'language' => 'th',
        'options' => [
          'placeholder' => '--- เลือก ---',
          'id' => 'prescription_error_id',
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
          echo $form->field($model, 'med_employee_id', [
            ])->widget(Select2::classname(), [
              'data' => ArrayHelper::map(MedEmployee::find()->all(),'id', 'generic_name'),
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
          <?php echo $form->field($model, 'lasa')->checkBoxList(['label' => 'lasa']);  ?>
  </div>
  <div class="col-md-6">
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
    <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>
  </div>
</div>
    <div class="form-group" style="float:right;padding-right:85px;">
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success ion-plus' : 'btn btn-primary']) ?>

    </div>
    <?php ActiveForm::end(); ?>

<?php
$js = <<< JS

$('#prescription-items').on('beforeSubmit', function () {
var form = $(this);
                // return false if form still have some validation errors
if (form.find('.has-error').length) {
return false;
}
$.ajax({
    url: form.attr('action'),
    type: 'post',
    data: form.serialize(),
//     success: function (response) { //ส่งข้อมูลสำเร็จ
// //  $.pjax.reload({container:'#pjax-container'});
//     $('#transcribing-items').trigger('reset');
//     $.pjax.reload({container:'#pjax-transcribing-items'});
//   },
}).done(function() {
  $('#prescription-items').trigger('reset');
  $.pjax.reload({container:'#pjax-prescription-items'});
  console.log("success");
})
.fail(function() {
  console.log("error");
})
.always(function() {
  console.log("complete");
});
return false;
});

JS;
$this->registerJs($js);
?>
