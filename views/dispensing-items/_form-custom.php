<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use risk\models\DispensingError;
use risk\models\DrugItems;
use risk\models\Authorities;
?>


  <?php $form = ActiveForm::begin([
    'action' => 'index.php?r=rm/dispensing-items/create',
    'id' => 'dispensing-items',
  'fieldConfig' => [
      'horizontalCssClasses' => [
          'label' => 'col-md-4',
          'offset' => 'col-md-offset-3',
          'wrapper' => 'col-md-6'
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
    echo $form->field($model, 'dispensing_error_id', [
      ])->widget(Select2::classname(), [
        'data' => ArrayHelper::map(DispensingError::find()->all(),'id', 'name'),
        'language' => 'th',
        'options' => [
          'placeholder' => '--- เลือก ---',
          'id' => 'dispensing_error_id',
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
            //  'id' => 'drug_items_id2',
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
$('#dispensing-items').on('beforeSubmit', function () {
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
$('#dispensing-items').trigger('reset');
$.pjax.reload({container:'#pjax-dispensing-items'});
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
