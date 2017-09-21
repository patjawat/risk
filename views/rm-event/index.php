<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\datecontrol\DateControl;
use risk\models\RmEvent;
use risk\models\RmItems;
use risk\models\RmLevelgroup;
use risk\models\RmWorkgroup;
use risk\models\RmGroup;
use risk\models\Editing;
use cenotia\components\modal\RemoteModal;
$this->title = "RM Manager | บริหารจัดการความเสี่ยงภายในองค์กร";
$this->params['breadcrumbs'][] = $this->title;
$event = new RmEvent();
?>
<?php  echo $this->render('_search', ['model' => $searchModel]); ?><br>
<?php RemoteModal::begin([
	"id"=>"modal",
	"options"=> [ "class"=>"fade slide-right "],
	"footer"=>"", // always need it for jquery plugin
	])?>
	<?php RemoteModal::end(); ?>
	<style media="screen">
	.modal.fade.slide-right .modal-dialog {
		height: 100%;
		width: 40%;
	}
	
	</style>
	<div class="rm-event-index">
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				// ['class' => 'yii\grid\SerialColumn'],
				[
				    'class'=>'kartik\grid\SerialColumn',
				    'contentOptions'=>['class'=>'kartik-sheet-style'],
				    'width'=>'36px',
				    'header'=>'',
				    'headerOptions'=>['class'=>'kartik-sheet-style']
				],

				[
					'attribute'=>'event_date',
					'vAlign'=>'middle',
					'width'=>'150px',
					'value'=>function ($model, $key, $index, $widget) {
						return Yii::$app->thaiFormatter->asDate($model->event_date, 'php:d/m/Y');
					},
				],
				[
					'attribute'=>'rm_group_id',
					'vAlign'=>'middle',
					'width'=>'500px',
					'value'=>function ($model, $key, $index, $widget) {
						return $model->rmGroup->rmWorkgroup->name;
					},
					'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(RmGroup ::find()->where(['NOT IN', 'id', ['00']])->all(), 'id', 'name'),
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
					],
					'filterInputOptions'=>['placeholder'=>'--Select--'],
					'format'=>'raw'
				],
				[
					'attribute' => 'rm_items_id',
					'width' => '500px;',
					'value' => function($model){
						return $model->rmItems->name;
					},
					'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(RmItems ::find()->all(), 'id', 'name'),
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
					],
					'filterInputOptions'=>['placeholder'=>'--Select--'],
					'format'=>'raw'
				],
				[
					'attribute' => 'editing_id',
					'width' => '500px;',
					'value' => function($model){
						return $model->editing->name;
					},
					'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(Editing::find()->all(), 'id', 'name'),
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
					],
					'filterInputOptions'=>['placeholder'=>'--Select--'],
					'format'=>'raw'
				],
			['class' => 'kartik\grid\ActionColumn'],
			],
			'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
			'headerRowOptions'=>['class'=>'kartik-sheet-style'],
			'filterRowOptions'=>['class'=>'kartik-sheet-style'],
			'responsive'=>true,
			'pjax' => true,
			'hover' => true,
			'exportConfig' => [
				GridView::PDF => [
					'label' => 'PDF',
					'filename' => 'Preceptors',
					'title' => 'Preceptors',
					'options' => ['title' => 'Preceptor List','author' => 'Me'],
				],
				GridView::CSV => [
					'label' => 'CSV',
					'filename' => 'Preceptors',
					'options' => ['title' => 'Preceptor List'],
				],
			],
			'export' => [
				'PDF' => [
					'options' => [
						'title' => 'Preceptors',
						'subject' => 'Preceptors',
						'author' => 'NYCSPrep CIMS',
						'keywords' => 'NYCSPrep, preceptors, pdf'
					]
				],
			],
			'pager' => [
				'options'=>['class'=>'pagination'],   // set clas name used in ui list of pagination
				'prevPageLabel' => 'Previous',   // Set the label for the "previous" page button
				'nextPageLabel' => 'Next',   // Set the label for the "next" page button
				'firstPageLabel'=>'First',   // Set the label for the "first" page button
				'lastPageLabel'=>'Last',    // Set the label for the "last" page button
				'nextPageCssClass'=>'next',    // Set CSS class for the "next" page button
				'prevPageCssClass'=>'prev',    // Set CSS class for the "previous" page button
				'firstPageCssClass'=>'first',    // Set CSS class for the "first" page button
				'lastPageCssClass'=>'last',    // Set CSS class for the "last" page button
				'maxButtonCount'=>10,    // Set maximum number of page buttons that can be displayed
			],
			// 'panel'=>['type'=>'primary', 'heading'=>'<i class="fa fa-database" aria-hidden="true"></i> แสดงอุบัติการความเสี่ยง'],
      'panel'=>[
          'type'=>GridView::TYPE_PRIMARY,
          'heading'=>'<i class="fa fa-list-ul" aria-hidden="true"></i> แสดงรายการอุบัติการณ์ความเสี่ยง',
          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
      ],
      'toolbar'=> [
          ['content'=>
          Html::a('<i class="glyphicon glyphicon-plus"></i> ลงบันทึกอุบัติการณ์', ['create'], ['class' => 'btn btn-success'])
              //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'22', 'class'=>'btn btn-success pull-left', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
          ],
          Html::a('<i class="glyphicon glyphicon-repeat"></i> คืนค่า', [''],
          ['data-pjax'=>1, 'class'=>'btn btn-warning', 'title'=>'Reset Grid']),
          Html::button('<i class="glyphicon glyphicon-trash"></i> ลบทั้งหมด', ['class' => 'btn btn-danger','id'=>'btn-delete']),
          '{export}',
          '{toggleData}',
      ],
			'headerRowOptions' => function(){
				return ['style'=>'background-color:#eee;'];
			},
			'rowOptions' => function ($model, $index, $widget, $grid){
			},
		]); ?>
