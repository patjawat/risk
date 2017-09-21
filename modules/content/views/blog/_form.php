<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use risk\modules\content\models\BlogCategory;
?>
<?php
        \yiister\adminlte\widgets\Box::begin(
            [
                "header" => "แบบฟร์อมการเขียนบทความ",
                 'icon' => "edit",
                "removable" => true,
            ]
        )
        ?>

<div class="row">
  <div class="col-md-12">


    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'title_image')->widget(InputFile::className(), [
        'language'      => 'th',
        'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple'      => false       // возможность выбора нескольких файлов
    ]);

    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
         'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
     ]); ?>

   </div>
 </div>
<div class="row">
  <div class="col-md-6">
    <?= $form->field($model, 'blog_category_id'
      )->widget(select2::classname(), [
        'data'=> ArrayHelper::map(BlogCategory::find()->all(),'id','name'),
      'options' => ['id' => 'code'],
      'pluginOptions' => [
        'allowClear' => true,
        'placeholder' => '--- Select ---',
      ],]);
    ?>
  </div>
  <div class="col-md-6">
    <?= $form->field($model, 'status')->radioList([ 'Y' => 'แสดงให้เห็น', 'N' => 'ไม่แสดง', ], ['prompt' => '','id' => 'status']) ?>
  </div>
</div>
<?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-saved"></i> บันทึก' : '<i class="glyphicon glyphicon-saved"></i> บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \yiister\adminlte\widgets\Box::end() ?>

<?php
$js = <<< JS
	// 	$(document).ready(function(){
	// 	  $('#status').iCheck({
	// 	    checkboxClass: 'icheckbox_flat-red',
	// 	    radioClass: 'icheckbox_flat-red'
	// 	  });
  // //     $('.iCheck-helper').click(function(){
  // //       $("body").LoadingOverlay("show");
  // //       $( "#form-order" ).submit();
  // // });
  //
  //
	// 	});
JS;
		$this->registerJS($js);
?>
