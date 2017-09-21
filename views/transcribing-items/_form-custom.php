<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use risk\models\TranscribingError;
use risk\models\DrugItems;
use risk\models\Authorities;


/* @var $this yii\web\View */
/* @var $model risk\models\TranscribingItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transcribing-items-form">

  <?php $form = ActiveForm::begin([
    'action' => 'index.php?r=rm/transcribing-items/create',
    'id' => 'transcribing-items',
  'fieldConfig' => [
      'horizontalCssClasses' => [
          'label' => 'col-md-4',
          'offset' => 'col-md-offset-3',
          'wrapper' => 'col-md-7'
      ]
  ],
  'layout' => 'horizontal'
  ]); ?>

<?php
//$rm_event_id = 1;
 ?>
    <?= $form->field($model, 'rm_event_id')->hiddenInput(['value' => $rm_event_id])->label(false); ?>
<div class="row">
  <div class="col-md-6">


    <?php
    echo $form->field($model, 'transcribing_error_id', [
      ])->widget(Select2::classname(), [
        'data' => ArrayHelper::map(TranscribingError::find()->all(),'id', 'name'),
        'language' => 'th',
        'options' => [
          'placeholder' => '--- เลือก ---',
          'id' => 'transcribing_error_id',
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
              'id' => 'drug_items_id',
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
    <div class="form-group" style="float:right;padding-right:78px;">
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success ion-plus' : 'btn btn-primary']) ?>

    </div>
      <?php // $form->field($model, 'laza')->textInput(['maxlength' => true]) ?>
      <?php //echo $form->field($model, 'authorities_id')->checkBoxList(yii\helpers\ArrayHelper::map(Authorities::find()->all(),'id','name'));  ?>
  </div>
</div>


    <?php ActiveForm::end(); ?>
</div>
<?php
$js = <<< JS

$('#transcribing-items').on('beforeSubmit', function () {
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
  $('#transcribing-items').trigger('reset');
  $.pjax.reload({container:'#pjax-transcribing-items'});
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
