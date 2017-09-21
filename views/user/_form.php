<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'form']); ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary  glyphicon glyphicon-ok']) ?>
        <a href="#" class="btn btn-warning glyphicon glyphicon-off"  data-dismiss="modal";>จบการทำงาน</a>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<br>
<div class="progress" hidden="">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="100" aria-valuemax="100" style="width: 0%">
    </div>
</div>
<br>
<?php
$js = <<< JS
//
// $('#form').on('beforeSubmit', function () {
//      var form = $(this);
//      // return false if form still have some validation errors
//      if (form.find('.has-error').length) {
//           return false;
//      }
//     //  $('#loading').html('<img src="loading.gif"> loading...');
//      $(".progress").show();
//      $('#form').hide();
//      // submit form
//            $.ajax({
//                 url: form.attr('action'),
//                 type: 'post',
//                 data: form.serialize(),
//                   async: true,
//                   xhr: function () {
//                        var xhr = new window.XMLHttpRequest();
//                        //Upload Progress
//                        xhr.upload.addEventListener("progress", function (evt) {
//                           if (evt.lengthComputable) {
//                          var percentComplete = (evt.loaded / evt.total) * 100; $('div.progress > div.progress-bar').css({ "width": percentComplete + "%" }); } }, false);
//
//                  //Download progress
//                   xhr.addEventListener("progress", function (evt)
//                   {
//                   if (evt.lengthComputable)
//                    { var percentComplete = (evt.loaded / evt.total) *100;
//                   $("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); } },
//                  false);
//                  return xhr;
//                  },
//               // beforeSend: function () {
//               // alert('send'); //ส่งข้อมูลไป
//               // },
//               success: function (response) { //ส่งข้อมูลสำเร็จ
//                 //$('#modal .modal-body').html(response);
//                 $('#form').trigger('reset');
//                 // $.pjax.reload({container:'#pjax-progress-bar'});
//                 $("div.progress > div.progress-bar").width(0);
//               },
//               complete: function () {  //เสร็จงาน
//                 $(".progress").hide();
//                 $('#form').show();
//               $.pjax.reload({container:'#pjax-container'});
//               alert('บันทึกสำเร็จ');
//               },
//      });
//        return false;
// });
JS;
$this->registerJs($js);
?>
