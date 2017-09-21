<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\RmType */
/* @var $form yii\widgets\ActiveForm */
?>
<style media="screen">
.form-group {
  margin-bottom: 0px;
}
.help-block {
    display: block;
    margin-top: 2px;
    margin-bottom: 3px;
    color: #737373;
}
.col-md-6 {
    position: relative;
    min-height: 1px;
    padding-right: 1px;
    padding-left: 1px;
}
.col-md-3 {
    width: 26%;
}
</style>
<div class="rm-type-form">
  <?php $form = ActiveForm::begin([
    'id' => 'form',
  'fieldConfig' => [
      'horizontalCssClasses' => [
          'label' => 'col-md-3',
          'offset' => 'col-md-offset-3',
          'wrapper' => 'col-md-6'
      ]
  ],
  'layout' => 'horizontal'
  ]); ?>
    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="row">
      <div class="col-md-12">
      <div class="form-group" style="padding-left:320px;padding-top:10px;">
          <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary  glyphicon glyphicon-ok']) ?>
          <a href="#" class="btn btn-danger glyphicon glyphicon-off"  data-dismiss="modal";>ปิด</a>
        </div>
        <div id="process" hidden=""  >
          <div id="success" hidden="">
            <h3 class="text-center">ดำเนินการเสร็จสิ <span class=" glyphicon glyphicon-ok"  style="color:#37BC9B;"></span></h3>
            <!-- <a href="#"  class="btn btn-danger glyphicon glyphicon-off "  data-dismiss="modal">ตกลง</a> -->
            <div class="text-center">
              <a href="#" class="btn btn-lg btn-success glyphicon glyphicon-off"  data-dismiss="modal";>ตกลง</a>
              <br><br>
            </div>
          </div>
          <div id="send" hidden="">
            <img src="loading-plugin.gif" style="padding-bottom:50px;">
          </div>
          <div class="progress" hidden="">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="100" aria-valuemax="100" style="width: 0%">
            </div>
          </div>
          <br><br>
        </div>
      </div>
    </div>
    <?php ActiveForm::end(); ?>


    <?php
    $js = <<< JS

    $('#form').on('beforeSubmit', function () {
    var form = $(this);
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
         return false;
    }
    //  $('#loading').html('<img src="loading.gif"> loading...');
    $(".progress").show();
    $('#form').hide();
    // submit form
          $.ajax({
               url: form.attr('action'),
               type: 'post',
               data: form.serialize(),
                 async: true,
                 xhr: function () {
                      var xhr = new window.XMLHttpRequest();
                      //Upload Progress
                      xhr.upload.addEventListener("progress", function (evt) {
                         if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100; $('div.progress > div.progress-bar').css({ "width": percentComplete + "%" }); } }, false);

                //Download progress
                 xhr.addEventListener("progress", function (evt)
                 {
                 if (evt.lengthComputable)
                  { var percentComplete = (evt.loaded / evt.total) *100;
                 $("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); } },
                false);
                return xhr;
                },
                beforeSend: function () {
                  $('#modal').modal('show')
                          .find('#modalContent')
                          .html($('#process'));
                 document.getElementById('modalHeader').innerHTML = '<h4>ผลการทำงาน</h4>';
                  $("#process").show();
               },
             success: function (response) { //ส่งข้อมูลสำเร็จ
               $.pjax.reload({container:'#pjax-container'});
               //$('#modal .modal-body').html(response);
               $('#form').trigger('reset');
               // $.pjax.reload({container:'#pjax-progress-bar'});
               $("div.progress > div.progress-bar").width(0);
             },
             complete: function () {  //เสร็จงาน
               $(".progress").hide();
               $('#form').show();
                $("#success").show();
              //  $('#modal .modal-body').modal('show').find('#modalContent').html($('#success'));
              $('#modal').modal('show')
                      .find('#modalContent')
                      .html($('#success'));
             document.getElementById('modalHeader').innerHTML = '<h1 class="text-center">ผลการทำงาน</h1>';
                $("div.progress > div.progress-bar").width(0);
             },
    });
      return false;
    });
JS;
$this->registerJs($js);
    ?>
