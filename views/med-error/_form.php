<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use risk\models\MedItems;
use risk\models\MedType;
use risk\models\MedEmployee;
?>
<?php $form = ActiveForm::begin(['id' => 'AddItems']); ?>
<div class="row">
  <div class="col-md-5">
    <?= $form->field($model, 'med_type_id'
      )->widget(select2::classname(), [
      'data'=> ArrayHelper::map(MedType::find()->all(),'id', 'name'),
      'options' => [
      'id' => 'med_type_id'],
      'pluginOptions' => [
        'allowClear' => true,
        'depends'=>['med_type_id'],
        'placeholder' => 'Enter...ระบุความคลาดเคลื่อน',
        //'url' => Url::to(['/rm/rm-event/med-type'])
      ],
    ]);
    ?>
  </div>
  <div class="col-md-3">
    <div style="margin-top:25px;">
    <?php echo $form->field($model, 'lasa')->checkBox(['label' => 'LASA']);  ?>
  </div>
  </div>
</div>
<?php echo $form->field($model,'rm_event_id')->hiddenInput(['maxlength' => 50])->label(false); ?>
  <?php
  echo $form->field($model, 'name', [
    'horizontalCssClasses' => [
      //'wrapper' => 'col-sm-5',
    ],
    ])->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
    //  'data' => ArrayHelper::map(RmLevel::find()->select(['concat(id) as lname', 'id','name'])->asArray()->all(),'id', 'lname'),
    //  'value' => $model->rm_level_id,
      'options' => [
        'id'=>'name',
        //  'onchange' => 'alert (this.value)',
      ],
      'pluginOptions'=>[
         'allowClear' => true,
        'depends'=>['med_type_id'],
        'placeholder' => 'Enter...ระดับความเสี่ยง',
         'url' => Url::to(['/med-items/get-items'])
      ]
    ]);
    ?>
    <?= $form->field($model, 'med_employee_id'
      )->widget(select2::classname(), [
      'data'=> ArrayHelper::map(MedEmployee::find()->all(),'id', 'name'),
      'options' => [
      'id' => 'med_employee_id'],
      'pluginOptions' => [
        'allowClear' => true,
        'depends'=>['med_employee_id'],
        'placeholder' => 'Enter...ชื่อเจ้าหน้าที่ผู้เกี่ยวข้อง',
      ],
    ]);
    ?>
    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>
<?php $form::end();?>
