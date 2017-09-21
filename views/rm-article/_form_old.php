<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use risk\models\RmArticleCategory;

/* @var $this yii\web\View */
/* @var $model risk\models\RmArticle */
/* @var $form yii\widgets\ActiveForm */
?>
<style media="screen">
.modal-dialog{
  width:70%;
}
</style>
<div class="rm-article-form" style="height:450px;">

    <?php $form = ActiveForm::begin(['id' => 'form']); ?>
    <div class="rows">
      <div class="col-md-8">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-md-4">

                <?php
                  echo $form->field($model, 'rm_article_category_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(RmArticleCategory::find()->all(),'id', 'name'),
                    'value' => $model->rm_article_category_id,
                    'language' => 'th',
                    'options' => ['placeholder' => 'Select a state ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                  ?>
      </div>
      </div>
        <div class="rows">
          <div class="col-md-12">
        <?php $form->field($model, 'discription')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'discription')->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'imageManagerJson' => ['/redactor/upload/image-json'],
        'imageUpload' => ['/redactor/upload/image'],
        'fileUpload' => ['/redactor/upload/file'],
        'lang' => 'th',
        'plugins' => ['clips', 'fontcolor','imagemanager']
    ]
])?>
      </div>
    </div>
    <div class="rows">
      <div class="col-md-6">
        <?= $form->field($model, 'start')->widget(DatePicker::ClassName(),
            [
            'name' => 'start',
            'options' => ['placeholder' => 'Select...','id' => 'start',],
            'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose'=>true,
            ]
            ]);?>
      </div>
      <div class="col-md-6">
        <?= $form->field($model, 'end')->widget(DatePicker::ClassName(),
            [
            'name' => 'end',
            'options' => ['placeholder' => 'Select...','id' => 'end',],
            'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose'=>true,
            ]
            ]);?>
      </div>
    </div>
    <div class="rows">
      <div class="col-md-6">

      </div>
      <div class="col-md-3">
          <?= $form->field($model, 'status')->radioList([ 1 => 'แสดง', 2 => 'ไม่แสดง', ], ['prompt' => '']) ?>
      </div>
      <div class="col-md-3">
          <?php // $form->field($model, 'title_image')->fileInput() ?>
          <?php echo $form->field($model, 'title_image')->widget(
    '\trntv\filekit\widget\Upload',
    [
        'url' => ['upload'],
        'sortable' => true,
        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
        'maxNumberOfFiles' => 3,
        'clientOptions' => [ '']
    ]
); ?>
      </div>
    </div>

  <br>
  <div class="rows">
    <div class="col-md-12">
          <?php  echo Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary glyphicon glyphicon-edit','id' => 'btn']) ?>
          <!-- <?php    Html::a('ยกเลิก', ['index'], ['class' => 'btn btn-danger glyphicon glyphicon-off']); ?> -->
          <a href="#" class="btn btn-warning glyphicon glyphicon-off"  data-dismiss="modal";>จบการทำงาน</a>
  </div>
 </div>
</div>


    <?php ActiveForm::end(); ?>

</div>
<br>

<div id="success" hidden="">
        <h3 class="text-center">บันทึกสำเร็จ <span class=" glyphicon glyphicon-ok"  style="color:#37BC9B;"></span></h3>
        <!-- <a href="#"  class="btn btn-danger glyphicon glyphicon-off "  data-dismiss="modal">ตกลง</a> -->
        <div class="text-center">

          <a href="#" class="btn btn-lg btn-success glyphicon glyphicon-off"  data-dismiss="modal";>ตกลง</a>
        </div>
      <br><br><br>
      </div>

<br>
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
