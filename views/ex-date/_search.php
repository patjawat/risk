<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\ExDateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ex-date-search">

  <?php $form = ActiveForm::begin([
          'action' => ['index'],
          'method' => 'get',
          'options' => ['data-pjax' => true ]
      ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'start') ?>

    <?= $form->field($model, 'end') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="show">

</div>
<?php
$js = <<< JS


// $('#search-form').on('beforeSubmit', function () {
// var form = $(this);
//                 // return false if form still have some validation errors
// if (form.find('.has-error').length) {
// return false;
// }
// $.ajax({
//     url: form.attr('action'),
//     type: 'get',
//     data: form.serialize(),
//     success: function (response) { //ส่งข้อมูลสำเร็จ
//     //  alert(response);
//       $('#show').html(response);
// //  $.pjax.reload({container:'#pjax-container'});
//     $('#transcribing-items').trigger('reset');
//   //  $.pjax.reload({container:'#pjax-transcribing-items'});
//   },
// }).done(function(data) {
//   //$('#transcribing-items').trigger('reset');
//   $('#').append(data);
//   $.pjax.reload({container:'#pjax-container'});
//   console.log("success");
// //  alert();
// })
// .fail(function() {
//   console.log("error");
// })
// .always(function() {
//   console.log("complete");
// });
// return false;
// });


// $(document).on('pjax:send', function() {
// //  $('#loading').show()
// alert();
// })
// $(document).on('pjax:complete', function() {
//   $('#loading').hide()
// })
JS;
$this->registerJS($js);

 ?>
