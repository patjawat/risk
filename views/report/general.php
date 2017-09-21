<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
// use kartik\growl\Growl;
use risk\models\RmItems;
use risk\models\Department;
use risk\models\RmWorkgroup;
 ?>

 <?php
 $gridColumns = [
   ['class' => 'kartik\grid\SerialColumn'],
   [
       'attribute' => 'name',
       'value' => function($model) {return $model['name'];},
       'header' => 'ชื่อรายการ',
        'width' => '20%',
    ],
    [
       'attribute' => 'total',
       'format' => 'raw',
       'header' => 'รวมทั้งหมด',
       'value' => function($model) {
           return '<div class="progress">
                 <div class="progress-bar progress-bar-striped" style="width:'.$model['total'].'%">
               '.$model['total'].'
             </div>
           </div>';
       },
   ],

 ];
  ?>
  <?php  $sql;?>
 <?php $form = ActiveForm::begin([
      //  'action' => ['department'],
        'method' => 'post',
    ]); ?>

    <div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'date1')->widget(DatePicker::ClassName(),
    [
    'name' => 'check_issue_date',
    'options' => ['placeholder' => 'Select date ...'],
    'pluginOptions' => [
    	'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
    ]
]);?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'date2')->widget(DatePicker::ClassName(),
    [
    'name' => 'check_issue_date',
    'options' => ['placeholder' => 'Select date ...'],
    'pluginOptions' => [
    	'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
    ]
]);?>
    </div>
    <div class="col-md-2">
      <?php
          // Normal select with ActiveForm & model
      echo $form->field($model, 'department_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Department::find()->all(), 'id','name'),
        'language' => 'th',
        'options' => ['placeholder' => 'Select...','id' => 'department_id'],
        'pluginOptions' => [
        'allowClear' => true
        ],
        ]);
        ?>
    </div>
    <div class="col-md-2">
      <?php
          // Normal select with ActiveForm & model
      echo $form->field($model, 'rm_workgroup_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(RmWorkgroup::find()->all(), 'id','name'),
        'language' => 'th',
        'options' => ['placeholder' => 'Select...','id' => 'rm_workgroup_id'],
        'pluginOptions' => [
        'allowClear' => true
        ],
        ]);
        ?>
    </div>
    <div class="col-md-2">
    	<div class="form-group" style="padding-top:25px;">
        <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-info  glyphicon glyphicon-search']) ?>
    </div>
    </div>

</div>

    <?php ActiveForm::end(); ?>
    <?php if ($model->date1 ==  null): ?>
    <?php echo $this->render( '@frontend/modules/rm/views/off'); ?>
    <?php else: ?>
      <div class="row">
          <div class="col-md-12">

         <!-- ส่วนแสดง Grid View -->
             <?php
             $fullExportMenu = ExportMenu::widget([
             'dataProvider' => $dataProvider,
               'columns' => $gridColumns,
               'target' => ExportMenu::TARGET_BLANK,
                 'fontAwesome' => true,
                         'asDropdown' => false, // this is important for this case so we just need to get a HTML list
                         'dropdownOptions' => [
                             'label' => '<i class="glyphicon glyphicon-export"></i> Full'
                         ],
                     ]);
                       echo GridView::widget([
                           'dataProvider' => $dataProvider,
                          // 'filterModel' => $searchModel,
                           'id' => 'idofyourpjaxwidget',
                            'pjax'=>true,
                            'pjaxSettings'=>[
                                'neverTimeout'=>true,
                            ],
                           'columns' => $gridColumns,
                           'panel' => [
                               'type' => GridView::TYPE_PRIMARY,
                               'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> รายการ</h3>',
                           ],
                           // the toolbar setting is default
                           'toolbar' => [
                               '{export}',
                               ['content'=>
                                   //Html::button('<i class="glyphicon glyphicon-plus"></i>เขียนอุบัติการณ์ความเสี่ยง', ['value' => Url::to(['rm-event/create']),'type'=>'button', 'title'=>Yii::t('kvgrid', 'แบบฟร์อมการลงบันทึกอุบัติการณ์ความเสี่ยง'), 'class'=>'showModalButton btn btn-success']) . ' '.
                                       Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['department'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
                               ],
                           ],
                           // configure your GRID inbuilt export dropdown to include additional items
                           'export' => [
                               'fontAwesome' => true,
                               'itemsAfter'=> [
                                   '<li role="presentation" class="divider"></li>',
                                   '<li class="dropdown-header">Export All Data</li>',
                                   $fullExportMenu
                               ]
                           ],
                       ]);
            ?>
       <?php endif; ?>
