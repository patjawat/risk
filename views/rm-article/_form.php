<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use risk\models\RmArticleCategory;
?>
<style media="screen">
.modal-dialog{
  width:60%;
}
</style>
<div class="rm-article-form">
  <div class="row">
    <div class="col-md-10">
      <div class="panel panel-info">
        <div class="panel-heading">
        แบบฟอร์อมการเขียนเนื้อหา
        </div>
        <div class="panel-body">

  <?php $form = ActiveForm::begin(['id' => 'form','type' => ActiveForm::TYPE_HORIZONTAL]); ?>

      <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
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

      <?= $form->field($model, 'discription')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
          'imageManagerJson' => ['/redactor/upload/image-json'],
          'imageUpload' => ['/redactor/upload/image'],
          'fileUpload' => ['/redactor/upload/file'],
          'lang' => 'th',
          'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
        ])?>


        <?php $form->field($model, 'start')->widget(DatePicker::ClassName(),
        [
          'name' => 'start',
          'options' => ['placeholder' => 'Select...','id' => 'start',],
          'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose'=>true,
          ]
        ]);?>
        <?php echo  $form->field($model, 'status')->radioList([ 1 => 'แสดง', 2 => 'ไม่แสดง', ], ['inline'=>true,'prompt' => '']) ?>
        <?php // $form->field($model, 'title_image')->fileInput() ?>




        <?php $form->field($model, 'end')->widget(DatePicker::ClassName(),
        [
          'name' => 'end',
          'options' => ['placeholder' => 'Select...','id' => 'end',],
          'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose'=>true,
          ]
        ]);?>
        <?php
      ?>

  <div class="form-group" style="padding-left:200px;">
      <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary  glyphicon glyphicon-ok']) ?>
      <a href="#" class="btn btn-danger glyphicon glyphicon-off"  data-dismiss="modal";>ปิด</a>
  </div>
</div>

<br>
<?php ActiveForm::end(); ?>
</div>
<div id="success" hidden="">
  <h3 class="text-center">บันทึกสำเร็จ <span class=" glyphicon glyphicon-ok"  style="color:#37BC9B;"></span></h3>
  <div class="text-center">
    <a href="#" class="btn btn-lg btn-success glyphicon glyphicon-off"  data-dismiss="modal";>ตกลง</a>
    <br><br><br><br>
  </div>
</div>
</div>
</div>



<?php
$js = <<< JS
//
// $('#form').on('beforeSubmit', function () {
//   var form = $(this);
//   // return false if form still have some validation errors
//   if (form.find('.has-error').length) {
//     return false;
//   }
//   // submit form
//   $.ajax({
//     url: form.attr('action'),
//     type: 'post',
//     data: form.serialize(),
//     // beforeSend: function () {
//     // alert('send'); //ส่งข้อมูลไป
//     // },
//     success: function (response) { //ส่งข้อมูลสำเร็จ
//       $.pjax.reload({container:'#pjax-container'});
//       $('#form').trigger('reset');
//       $("div.progress > div.progress-bar").width(0);
//     },
//     complete: function () {  //เสร็จงาน
//       $("#success").show();
//       $('#modal').modal('show')
//       .find('#modalContent')
//       .html($('#success'));
//       document.getElementById('modalHeader').innerHTML = '<h4>ผลการทำงาน</h4>';
//       $("div.progress > div.progress-bar").width(0);
//     },
//   });
//   return false;
// });

function Alert(){
  $('#modal-dialog').modal('hide');
  $('#modal').modal('hide');
}
JS;
$this->registerJs($js);
?>
