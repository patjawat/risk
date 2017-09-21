<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use cenotia\components\modal\RemoteModal;
use yii\db\Query;
use risk\models\RmEventHasLeveleffect;
use risk\models\PrescriptionItems;
use risk\models\PrescriptionItemsSearch;
use risk\models\TranscribingItems;
use risk\models\DispensingItems;
use risk\models\DispensingItemsSearch;
use risk\models\AdministrationItems;
use risk\models\AdministrationItemsSearch;
use risk\models\TranscribingItemsSearch;
use risk\models\MedError;
use risk\models\MedItems;
use risk\models\MedType;
use risk\models\MedEmployee;
use risk\models\RmItems;
$this->title = 'อุบัติการณ์ความเสี่ยงที่ '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'อุบัติการความเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
RemoteModal::begin([
  "id"=>"modal",
  "options"=> [ "class"=>"fade stick-up"],
  "footer"=>"", // always need it for jquery plugin
])
?>
<?php RemoteModal::end(); ?>
<!-- ตรวจสอบว่าเป็นความคลาดเคลื่อนทางยา -->
<?php
$id = $model->rm_items_id;
$key = ['Administration','dispensing','prescribing'];
$med = RmItems::find()->where(['id' => $id])
->andwhere(['in', 'specific_clinical_id', $key])->count();
?>


<style media="screen">
.modal.fade.stick-up.in .modal-dialog {
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  -ms-transform: translate(0, 0);
  width: 60%;
  padding-top: 5%;
}
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


    <?php if (!Yii::$app->user->isGuest): ?>
      <p>
        <?= Html::a('เพิ่มใหม่', ['/rm-event/create'], ['class' => 'btn btn-md btn-success glyphicon glyphicon-plus']) ?>
        <?= Html::a('แก้ไข', ['/rm-event/update', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id, 'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id], ['class' => 'btn btn-primary glyphicon glyphicon-edit']) ?>
        <?= Html::a('ทบทวน', ['review', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id,'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id],
        ['class' => 'btn btn-warning glyphicon glyphicon-refresh','role' => 'modal' ]);
        ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i> ลบ', ['delete', 'id' => $model->id, 'rm_level_id' => $model->rm_level_id, 'rm_levelgroup_id' => $model->rm_levelgroup_id, 'rm_items_id' => $model->rm_items_id, 'rm_group_id' => $model->rm_group_id, 'rm_workgroup_id' => $model->rm_workgroup_id, 'rm_type_id' => $model->rm_type_id, 'rm_reporttype_id' => $model->rm_reporttype_id,'accident_id' => $model->accident_id, 'urgent_id' => $model->urgent_id, 'editing_id' => $model->editing_id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
        ],
        ]) ?>

      </p>
    <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <?php
          \yiister\adminlte\widgets\Box::begin(
            [
              "header" => $model->rmItems->name,
              "icon" => "tasks",
              "type" => \yiister\adminlte\widgets\Box::TYPE_SUCCESS,
              "removable" => true,
            ]
            )?>
            <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                //'userreport.username',
                [
                  'label' => 'วันที่เกิดเหตุ',
                  'format' =>'html',
                  'value' => '<span class="glyphicon glyphicon-calendar"></span>'.Yii::$app->thaiFormatter->asDateTime($model->event_date, 'php:d/m/Y H:i:s'),
                ],

                'rmItems.rmType.name',
                [
                  'label' => 'กลุ่มความเสี่ยง',
                  'value' => $model->rmItems->rmGroup->name,
                ],
                [
                  'label' => 'ชื่อความเสี่ยง',
                  'value' => $model->rmItems->name,
                ],
                'rm_event_note:html',
                'rm_level_id',
                'rmLevel.rmLevelgroup.name',
                'rmDepartmentPosition.department.name',
                'rmDepartmentPosition.name',
                'accident.name',
                'editing.name',
                'review:html',
                [
                  'label' => 'วันที่รายงาน',
                  'format' =>'html',
                  'value' => '<span class="glyphicon glyphicon-calendar"></span>'.Yii::$app->thaiFormatter->asDateTime($model->report_date, 'php:d/m/Y'),
                ],
                //'accident_name',
              ],
              ]) ?>
              <?php \yiister\adminlte\widgets\Box::end() ?>

            </div>

          </div>

    <!-- แสดงความคลาดเคลื่อนทางยา -->

<?php  if ($med == 1): ?>
      <?php
      \yiister\adminlte\widgets\Box::begin(
        [
          "header" => "ความคลาดเคลื่อนทางยา",
          'icon' => "check",
          "type" => \yiister\adminlte\widgets\Box::TYPE_SUCCESS,
          "removable" => true,
        ]
        )?>

    <?php Pjax::begin(['id' => 'pjax-container'])?>
    <?php
    $dataProvider = new ArrayDataProvider([
         'allModels' => $model->isNewRecord ? $cart->contents(): MedError::find()->where(['rm_event_id' => $model->id])->all(),
        //'allModels' => $cart->contents(),
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'attributes' => ['id', 'name'],
        ],
    ]);
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
        ],
    ]);
     ?>

     <?php Pjax::end();?>
         <?php \yiister\adminlte\widgets\Box::end() ?>

     <?php  endif; ?>


     <!-- จบความคลาดเคลื่อทางยา -->

    <div class="panel panel-default">
      <div class="panel-body">
        <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->id)]);?>
      </div>
    </div>

<div class="" hidden="">
<!-- ถ้าเอาออก  Modal จะไม่ทำงาน -->
    <?php
    $searchModel = new PrescriptionItemsSearch();
    $searchModel->rm_event_id = $model->id;
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    echo $this->render('@risk/views/prescription-items/index',[
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'id' => $model->id
    ]);
     ?>
     </div>
