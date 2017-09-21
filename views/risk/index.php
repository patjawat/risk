<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use risk\models\RmEvent;
use risk\models\RmArticle;
use risk\modules\content\models\Blog;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;


HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);
$event = new RmEvent();
$all = RmEvent::find()->count();
$non = RmEvent::find()->where(['rm_type_id' => 'non-clinic'])->count();
$clinic = RmEvent::find()->where(['rm_type_id' => 'clinic'])->count();
$edit = RmEvent::find()->where(['editing_id' => 2])->count();
$formatter = \Yii::$app->formatter;
$this->title = "RM Manager | บริหารจัดการความเสี่ยงภายในองค์กร";
?>
<style media="screen">
.products-list>.item {
  padding: 3px 0;
}
</style>
<div class="row">
    <div class="col-lg-4 col-xs-6">
        <?=
        yiister\adminlte\widgets\InfoBox::widget(
            [
                "color" => \yiister\adminlte\components\AdminLTE::BG_AQUA,
                "icon" => "bookmark-o",
                "text" => "ความเสี่ยงทั้งหมด",
                "number" => $event->countAll(),
            ]
        )
        ?>
    </div>
    <div class="col-lg-4 col-xs-6">
        <?=
        yiister\adminlte\widgets\InfoBox::widget(
            [
                "color" => \yiister\adminlte\components\AdminLTE::BG_GREEN,
                "icon" => "thumbs-o-up",
                "text" => "ได้รับการทบทวนแก้ไข",
                "number" => $event->countEditing1(),
            ]
        )
        ?>
    </div>
    <div class="col-lg-4 col-xs-6">
        <?=
        yiister\adminlte\widgets\InfoBox::widget(
            [
                "color" => \yiister\adminlte\components\AdminLTE::BG_YELLOW,
                "icon" => "calendar",
                "text" => "ยังไม่ทบทวน",
                "number" => $event->countEditing2(),
            ]
        )
        ?>
    </div>

</div>

<?php \yiister\adminlte\widgets\Box::begin(
           [
               "header" => "อุบัติการความเสี่ยงที่เกิดขึ้น",
               "icon" => "tasks",
               "type" => \yiister\adminlte\widgets\Box::TYPE_PRIMARY,
               "removable" => true,
           ]
       )?>

<?php
$group_sql = "SELECT g.id as gid,g.name as gname,i.name as iname,COUNT(e.id) as y FROM rm_event e
LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
LEFT OUTER JOIN rm_items i ON i.id = e.rm_items_id
GROUP BY g.id";
$group = Yii::$app->risk->createCommand($group_sql)->queryAll();
foreach ($group as $model) {
 $group_data[] = [
   'name' => $model['gname'],
   'y' => $model['y']*1,
   'drilldown' => $model['gid']
 ];
 $group_cat[] = [$model['gname']];
}

// Dilldown
$dilldown_sql ="SELECT g.id as gid,g.name as gname,i.name as iname,COUNT(e.id) as y FROM rm_event e
LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
LEFT OUTER JOIN rm_items i ON i.id = e.rm_items_id
GROUP BY i.id";
foreach (Yii::$app->risk->createCommand($dilldown_sql)->queryAll() as $model) {
  $rmevent = new RmEvent();
 $dilldown[] = [
         'name'=> $model['iname'],
         'id'=> $model['gid'],
         'data'=> $rmevent->dilldownall($model['gid'])
 ];
}

echo Highcharts::widget([
  'options' => [
    'chart'=> [
            'type'=> 'column'
        ],
        'title'=> [
            'text'=> 'สรุปการเกิดอุบัติการณ์'
        ],
        'subtitle'=> [
            'text'=> 'คลิกที่กราฟเพื่อดูข้อมูล'
        ],
        'xAxis'=> [
            'type'=> 'category'
        ],
        'yAxis'=> [
            'title'=> [
                'text'=> 'Total percent market share'
            ]

        ],
        'legend'=> [
            'enabled'=> false
        ],
        'plotOptions'=> [
            'series'=> [
                'borderWidth'=> 0,
                'dataLabels'=> [
                    'enabled'=> true,
                    'format'=>'{point.y:.1f}%'
                ]
            ]
        ],
        'tooltip'=> [
            'headerFormat'=> '<span style="font-size:11px">{series.name}</span><br>',
            'pointFormat'=> '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> จากทั้งหมด<br/>'
        ],
        'series'=> [[
            'name'=> 'Brands',
            'colorByPoint'=> true,
            'data'=> $group_data,
        ]],
         'drilldown'=>
        [
          'series'=> $dilldown
        ]
     ]
]);
 ?>
<?php \yiister\adminlte\widgets\Box::end() ?>
<div class="row">
      <div class="col-lg-7 col-md-7 col-sm-7">
      <?php \yiister\adminlte\widgets\Box::begin(
           [
               "header" => "ข่าวประชาสัมพันธ์",
               "icon" => "bullhorn",
               "type" => \yiister\adminlte\widgets\Box::TYPE_PRIMARY,
               "removable" => true,
           ]
       )?>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => Blog::find()->where(['blog_category_id' => 'news','status' => 'Y'])->orderBy(['create_at' => SORT_DESC]),
        'pagination' => [
            'pageSize' => 8,
        ],   
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'header' => 'เรื่อง',
                'format' => 'html',
                'width' => '75%',
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($model) {
                  return  Html::a($model->name, ['view-blog', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id], ['class' => '']);
                },
            ],
            [
                'header' => 'โพสเมื่อ',
                'format' => 'html',
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($model) {
                  return '<code><i class="fa fa-calendar-o" aria-hidden="true"></i></code> '.Yii::$app->thaiFormatter->asDate($model->create_at, 'php:d/m/Y');
                },
            ],
            [
                'header' => 'ผู้เขียน',
                'format' => 'html',
                'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($model) {
                  return '<code><i class="fa fa-user" aria-hidden="true"></i></code>'.$model->user->username;
                },
            ],
        ],
    ]);
    ?>
        
        
        <?php \yiister\adminlte\widgets\Box::end() ?>

      </div>

      <div class="col-lg-5 col-md-5 col-sm-5">

      <?php \yiister\adminlte\widgets\Box::begin(
           [
               "header" => "บทความ",
               "icon" => "book",
               "type" => \yiister\adminlte\widgets\Box::TYPE_PRIMARY,
               "removable" => true,
           ]
       )?>
                      <ul class="products-list product-list-in-box">
                        <?php foreach (Blog::find()->where(['blog_category_id' => 'risk','status' => 'Y'])->all() as $model): ?>
                        <li class="item">
                          <div class="product-img">
                            <img src="http://placehold.it/130x130" class="img-thumbnail" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <?=Html::a($model->name, ['view-blog', 'id' => $model->id, 'blog_category_id' => $model->blog_category_id], ['class' => '']);?>
                                <span class="product-description">
                                      <code><i class="fa fa-user" aria-hidden="true"></i></code><?=$model->user->username;?>
                                    </span>
                          </div>
                        </li>
                        <?php endforeach; ?>
                        <!-- /.item -->
                      </ul>
                      <div class="box-footer text-center">
                        <?=Html::a('แสดงทั้งหมด',['/risk/view-all']);?>

                      </div>
                      <?php \yiister\adminlte\widgets\Box::end() ?>
      </div>
    </div>