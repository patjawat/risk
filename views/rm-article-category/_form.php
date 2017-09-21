<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model risk\models\RmArticleCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rm-article-category-form">

    <?php $form = ActiveForm::begin(['id' => 'form']); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary  glyphicon glyphicon-ok']) ?>
        <?php echo Html::submitButton('ปิด',['class' => 'btn btn-danger glyphicon glyphicon-off', 'data-dismiss'=>'modal']); ?>
    </div>
<br>
    <?php ActiveForm::end(); ?>

</div>

<div id="success" hidden="">
        <h3 class="text-center">บันทึกสำเร็จ <span class=" glyphicon glyphicon-ok"  style="color:#37BC9B;"></span></h3>
        <!-- <a href="#"  class="btn btn-danger glyphicon glyphicon-off "  data-dismiss="modal">ตกลง</a> -->
        <div class="text-center">

          <a href="#" class="btn btn-lg btn-success glyphicon glyphicon-off"  data-dismiss="modal";>ตกลง</a>
        </div>
      <br><br><br>
      </div>

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
              // beforeSend: function () {
              // alert('send'); //ส่งข้อมูลไป
              // },
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
              document.getElementById('modalHeader').innerHTML = '<h4>ผลการทำงาน</h4>';
                 $("div.progress > div.progress-bar").width(0);
              },
     });
       return false;
});

function Alert(){
    $('#modal-dialog').modal('hide');
     $('#modal').modal('hide');
}

JS;
$this->registerJs($js);
?>
