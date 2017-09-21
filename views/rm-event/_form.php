<?php

// use yii\helpers\Html;
use kartik\helpers\Html;
use yii\db\Expression;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\grid\GridView;
use kartik\widgets\DepDrop;
use kartik\dialog\Dialog;
use kartik\widgets\FileInput;
use kartik\select2\Select2;
// use yii\bootstrap\ActiveForm;
use kartik\form\ActiveForm;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use yii\widgets\MaskedInput;
use kartik\time\TimePicker;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use yii\bootstrap\Modal;
use risk\models\Department;
use risk\models\RmDepartmentPosition;
use risk\models\RmType;
use risk\models\RmGroup;
use risk\models\Rmitems;
use risk\models\RmLevel;
use risk\models\RmLevelgroup;
use risk\models\RmWorkgroup;
use risk\models\RmReporttype;
use risk\models\RmEffect;
use risk\models\Urgent;
use risk\models\Accident;
use risk\models\Editing;
use risk\models\DrugItems;
use risk\models\MedItems;
use risk\models\MedError;
use risk\models\MedType;
use risk\models\MedEmployee;
use risk\models\Cart;
use common\models\User;
use yii\widgets\Pjax;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
CrudAsset::register($this);
//*list model
$type  = ArrayHelper::map(RmType::find()->all(),'id', 'name');
$group = ArrayHelper::map(RmGroup::find()->all(),'id', 'name');
Pjax::begin(['id' => 'crud-datatable-pjax']);
$department = ArrayHelper::map(Department::find()->all(), 'department_id','name');
$RmDepartmentPosition = ArrayHelper::map(RmDepartmentPosition::find()->all(), 'id','name');
Pjax::end();
$cart = new Cart();
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
</style>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",
])?>
<?php Modal::end(); ?>

<?php $form = ActiveForm::begin([
  'id' => 'dynamic-form',
  'options' => ['enctype' => 'multipart/form-data'],
  'type' => ActiveForm::TYPE_HORIZONTAL,
  'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
]); ?>
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs pull-right">
    <li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">ภาพประกอบเหตุการร์</a></li>
    <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="true">ข้อมูลอื่นที่อาจเกี่ยวข้อง</a></li>
    <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">บันทึกเหตการณ์</a></li>
    <li class="pull-left header"><i class="fa fa-th"></i>แบบฟอร์บันทึกอุบัติการณ์ความเสี่ยง</li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1-1">
      <?php echo $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>
      <div class="row">
        <div class="col-md-10">
          <?php Pjax::begin(['id' => 'items-datatable-pjax']); ?>
          <?= $form->field($model, 'rm_items_id',[
            'addon' => [
              'append' => [
                'content' => Html::a('<i class="glyphicon glyphicon-cog"></i>', ['/rm-items/create-setting'],
                ['role'=>'modal-remote','title'=> 'Create new Departments','class'=>'btn btn-default']),
                'asButton' => true
              ]
            ],
          ]
          )->widget(select2::classname(), [
            'data'=> ArrayHelper::map(Rmitems::find()->all(),'id', 'name'),
            'options' => [
              'id' => 'rm_items_id'],
              'pluginOptions' => [
                'allowClear' => true,
                'depends'=>['rm_group_id'],
                'placeholder' => 'Enter...ชื่อความเสี่ยง',
                'url' => Url::to(['/rm-event/items'])
              ],]);
              ?>
              <?php
              echo $form->field($model, 'rm_level_id', [
                ])->widget(DepDrop::classname(), [
                  'type'=>DepDrop::TYPE_SELECT2,
                  'options' => [
                    'id'=>'rm_level_id',
                  ],
                  'pluginOptions'=>[
                    'allowClear' => true,
                    'depends'=>['rm_items_id'],
                    'placeholder' => 'Enter...ระดับความเสี่ยง',
                    'url' => Url::to(['/rm-event/level'])
                  ]
                ]);
                ?>
                <?php Pjax::end();?>
                <?=$form->field($model, 'event_date')->widget(DateControl::classname(),
                  ['readonly' => true,
                    'type'=>DateControl::FORMAT_DATETIME]);?>

                  <?php echo $form->field($model, 'accident_id', [
                    ])->dropDownList(ArrayHelper::map(Accident::find()->all(),'id', 'name'), ['prompt' => '--- เลือก ---','id' => 'accident']) ?>
                    <?php
                    echo $form->field($model, 'department_id', [
                      ])->widget(Select2::classname(), [
                        'data' => $department,
                        'language' => 'th',
                        'options' => ['placeholder' => 'Enter...หน่วยงานที่เกิดเหตุ',
                        'id' => 'department_id'],
                        'pluginOptions' => [
                          'allowClear' => true
                        ],'addon' => [
                          'append' => [
                            'content' => Html::a('<i class="glyphicon glyphicon-cog"></i>', ['/department/create-setting'],
                            ['role'=>'modal-remote','title'=> 'Create new Departments','class'=>'btn btn-default']),
                            'asButton' => true
                          ]
                        ],
                      ]
                    );
                    ?>
                    <?php
                    // Dependent Dropdown
                    echo $form->field($model, 'rm_department_position_id', [
                      'addon' => ['append' => ['content'=>Html::a('<i class="glyphicon glyphicon-cog"></i>', ['/rm-department-position/create-setting'],
                      ['role'=>'modal-remote','title'=> 'Create new Departments','class'=>'btn btn-default']),'asButton' => true]]
                      ])->widget(DepDrop::classname(), [
                        'type'=>DepDrop::TYPE_SELECT2,
                        'options' => [
                          'id'=>'rm_department_position_id',
                        ],
                        'pluginOptions'=>[
                          'allowClear' => true,
                          'depends'=>['department_id'],
                          'placeholder' => 'Enter...จุดเกิดเหตุ',
                          'url' => Url::to(['/rm-event/department-position'])
                        ]]);?>
                      <?=$form->field($model, 'related')->widget(Select2::classname(), [
                        'data' => $department,
                        'language' => 'th',
                        'options' => ['placeholder' => 'Enter...หน่วยงานที่เกี่ยวข้องกับเหตุการณ์',
                        'id' => 'related'],
                        'pluginOptions' => [
                          'allowClear' => true,
                          'multiple' => true
                        ],
                      ]);
                      ?>
                      <?= $form->field($model, 'rm_event_note')->widget(\yii\redactor\widgets\Redactor::className(), [
                          'clientOptions' => [
                            'imageManagerJson' => ['/redactor/upload/image-json'],
                            'imageUpload' => ['/redactor/upload/image'],
                            'fileUpload' => ['/redactor/upload/file'],
                            'lang' => 'th',
                            'plugins' => ['clips', 'fontcolor','imagemanager']
                          ],])?>
                        </div>
                      </div>
                      <!-- เมื่อเป็รความเสี่ยงด้านยา ให้แสดง -->
                      <div class="" id="response" hidden="">
                        <?php
                        if ($model->isNewRecord):?>
                        <?= Html::a('เพิ่ม', ['/med-error/add-items'],['class' => 'btn btn-primary pull-right glyphicon glyphicon-plus','role' => 'modal' ]);?>
                      <?php else: ?>
                        <?= Html::a('เพิ่ม', ['/med-error/create','id' => $model->id],['class' => 'btn btn-primary pull-right glyphicon glyphicon-plus','role' => 'modal' ]);?>
                      <?php endif;?>
                      <?php Pjax::begin(['id' => 'pjax-container'])?>
                      <?php
                      $dataProvider = new ArrayDataProvider([
                        'allModels' => $model->isNewRecord ? $cart->contents(): MedError::find()->where(['rm_event_id' => $model->id])->all(),
                        'pagination' => [
                          'pageSize' => 10,
                        ],
                        'sort' => [
                          'attributes' => ['id', 'name'],
                        ],]);
                      echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                          ['class' => 'yii\grid\SerialColumn'],
                          [
                            'attribute' => 'ความคลาดเคลื่อน',
                            'value' => function($model){
                              return MedItems::find()->where(['id' => $model['id']])->where(['med_type_id' => $model['med_type_id']])->one()->name;
                            }
                          ],
                          [
                            'attribute' => 'LASA',
                            'value' => function($model){
                              if ($model['lasa'] == true) {
                                return 'LASA';
                              }else {
                                return '';
                              }
                            }
                          ],
                          [
                            'attribute' => 'ประเภท',
                            'value' => function($model){
                              return MedType::find()->where(['id' => $model['med_type_id']])->one()->name;
                            }
                          ],
                          [
                            'attribute' => 'เจ้าหน้าที่',
                            'value' => function($model){
                              return MedEmployee::find()->where(['id' => $model['med_employee_id']])->one()->name;
                            }
                          ],
                          [
                            'attribute' => 'รายละเอียด',
                            'value' => function($model){
                              return $model['note'];
                            }
                          ],

                          [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{update} {delete} ',
                            'options'=> ['style'=>'width:15%;'],
                            'buttons'=>[
                              'update' => function($url,$model,$key){
                                if(!$model['rowid']){
                                  $id = $model['id'];
                                  return Html::a('', ['/med-error/update','id' => $id],['class' => 'glyphicon glyphicon-edit','role' => 'modal' ]);
                                }else {}
                                },
                                'delete' => function($url,$model,$key){
                                  if(!$model['rowid']){
                                    $id = $model['id'];
                                    return Html::a(Yii::t('yii', ''), '#', [
                                      'class' => ' glyphicon glyphicon-trash',
                                      'title' => Yii::t('yii', 'Delete'),
                                      'aria-label' => Yii::t('yii', 'Delete'),
                                      'onclick' => "
                                      if (confirm('ลบข้อมูล?')) {
                                        $.ajax('index.php?r=med-error/delete&id=$id', {
                                          type: 'POST',
                                        }).done(function(data) {
                                          $.pjax.reload({container: '#pjax-container'});
                                        });
                                      }
                                      return false;
                                      ",
                                    ]);
                                  }else {
                                    $id =$model['rowid'];
                                    return Html::a(Yii::t('yii', ''), '#', [
                                      'class' => ' glyphicon glyphicon-trash',
                                      'title' => Yii::t('yii', 'Delete'),
                                      'aria-label' => Yii::t('yii', 'Delete'),
                                      'onclick' => "
                                      if (confirm('ลบข้อมูล?')) {
                                        $.ajax('index.php?r=rm/med-error/del-items&id=$id', {
                                          type: 'get',
                                        }).done(function(data) {
                                          $.pjax.reload({container: '#pjax-container'});
                                        });
                                      }
                                      return false;
                                      ",
                                    ]);
                                  }
                                },

                              ]
                            ],
                          ],
                        ]);
                        ?>
                      </div>
                      <!-- จบความคลาดเคลื่อทางยา -->
                      <?php Pjax::end();?>
                    </div>
                    <div class="tab-pane " id="tab_2-2">
                      <div class="row">
                        <div class="col-md-6">
                          <?= $form->field($model, 'accident_name')->textInput(['placeholder' => 'Enter...ชื่อผู้ประสบเหตุ',]) ?>
                          <?= $form->field($model, 'age', [
                            ])->widget(MaskedInput::className(), [
                              'mask' => '99',
                              ]) ?>
                              <?= $form->field($model, 'hn')->textInput(['placeholder' => 'Enter...HN',]); ?>
                              <?= $form->field($model, 'an')->textInput(['placeholder' => 'Enter...AN']) ?>
                            </div>
                            <div class="col-md-6">

                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_3-2">
                          <?php
                          echo FileInput::widget([
                            'name' => 'upload_ajax[]',
                            'options' => ['multiple' => true,'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                            'pluginOptions' => [
                              'overwriteInitial'=>false,
                              'initialPreviewShowDelete'=>true,
                              'initialPreview'=> $initialPreview,
                              'initialPreviewConfig'=> $initialPreviewConfig,
                              'uploadUrl' => Url::to(['/rm-event/upload-ajax']),
                              'uploadExtraData' => [
                                'ref' => $model->ref,
                              ],
                              'maxFileCount' => 100
                            ]
                          ]);
                          ?>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group" style="padding-left:20px;">
                              <?php  echo Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success glyphicon glyphicon-ok' : 'btn btn-primary glyphicon glyphicon-edit','id' => 'btn']) ?>
                              <?php echo  Html::a('ยกเลิก', ['index'], ['class' => 'btn btn-danger glyphicon glyphicon-off']); ?>
                            </div>
                          </div>
                        </div>
                        <!-- ##################### -->
                      </div>
                    </div>
                    <?=$form->field($model, 'rm_reporttype_id')->hiddenInput(['value' => 4])->label(false); ?>
                    <?=$form->field($model, 'urgent_id')->hiddenInput(['value' => 3])->label(false); ?>
<?php ActiveForm::end(); ?>
<?php
$js = <<< JS
$(function(){
$.ajax({
  url: 'index.php?r=rm-event/checkmed',
  type: 'get',
  data: {id: $("#rm_items_id").val()},
  success: function(data){
    if(data == 1){
      $("#response").show()
    }else {
      $("#response").hide();
    }
}
})

  $('#rm_items_id').change(function(event) {
    $.ajax({
      url: 'index.php?r=rm-event/checkmed',
      type: 'get',
      //dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
      data: {id: $(this).val()},
      success: function(data){
        if(data == 1){
          $("#response").show()
        }else {
          $("#response").hide();
        }
    }
    })
  });
  $('#editing').select(
      function(){
          if ($(this).is(':checked') && $(this).val() == 'Yes') {
              // append goes here
          }
      });

});

JS;
$this->registerJs($js);
?>
