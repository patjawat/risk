<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
// use yii\grid\GridView;s
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $searchModel risk\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
<?php Pjax::begin(); ?>
     <?php

                 echo GridView::widget([
                     'dataProvider' => $dataProvider,
                     'filterModel' => $searchModel,
                     'id' => 'idofyourpjaxwidget',
                      'pjax'=>true,
                      'pjaxSettings'=>[
                          'neverTimeout'=>true,
                      ],
                     'columns' => [
                         ['class' => 'kartik\grid\SerialColumn'],
                                  'username',
                                  'email:email',
                                  'password_hash',
                                  'auth_key',
                     ],
                     'panel' => [
                         'type' => GridView::TYPE_PRIMARY,
                         'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> รายการผู้ใช้งานในระบบความเสี่ยง</h3>',
                     ],
                     // the toolbar setting is default
                     'toolbar' => [
                         '{export}',
                         ['content'=>
                             Html::button('<i class="glyphicon glyphicon-plus"></i>เพิ่มผู้ใช้งาน', ['value' => Url::to(['user/create']),'type'=>'button', 'title'=>'เพิ่มผู้ใช้งานในระบบ', 'class'=>'showModalButton btn btn-danger']) . ' '.
                                 Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
                         ],
                     ],
                     // configure your GRID inbuilt export dropdown to include additional items

                 ]);
                     ?>
<?php Pjax::end(); ?></div>
