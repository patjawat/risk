<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use risk\models\Department;

$this->title = 'เมนูการตั้งค่า';
$this->params['breadcrumbs'][] = $this->title;
use \yii\web\Request;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl()).'/modules/rm/assets/images/';
echo Html::img($baseUrl.'carousel1.jpg');
?>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo Department::find()->count(); ?></h3>

              <p>แผนก/ฝ่าย</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">
              ตั้งค่า <i class="fa fa-arrow-circle-right"></i>
            </a> -->
            <?=Html::a('ตั้งค่า',['/rm/department'],['class' => 'small-box-footer' ]) ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>

<div class="row demo-tiles">
  <div class="col-xs-3">
    <div class="tile">
      <?= Html::img($baseUrl.'/icon-svg/parallel_tasks.svg',[
        'class' => 'tile-image big-illustration',
        'width' => 30
      ]);?>
      <h4 class="tile-title">แผนก-ฝ่าย
      </h4>
      <?=Html::a('เลือก',['/rm/department'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="tile">
      <?= Html::img($baseUrl.'/icon-svg/collect.svg',[
        'class' => 'tile-image big-illustration',
        'width' => 30
      ]);?>
      <h4 class="tile-title">จุดเกิดเหตุ
      </h4>
      <?=Html::a('เลือก',['/rm/rm-department-position'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="tile">
      <?= Html::img($baseUrl.'/icon-svg/conference_call.svg',[
        'class' => 'tile-image big-illustration',
        'width' => 30
      ]);?>
      <h4 class="tile-title">ทีมคร่อม</h4>
      <?=Html::a('เลือก',['/rm/rm-workgroup'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="tile">
      <?= Html::img($baseUrl.'/icon-svg/mind_map.svg',[
        'class' => 'tile-image big-illustration',
        'width' => 30
      ]);?>
      <h4 class="tile-title">ประเภทความเสี่ยง</h4>
      <?=Html::a('เลือก',['/rm/rm-type'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
    </div>
  </div>

<div class="col-xs-3">
<div class="tile">
  <?= Html::img($baseUrl.'/icon-svg/briefcase.svg',[
    'class' => 'tile-image big-illustration',
    'width' => 30
  ]);?>
  <h4 class="tile-title">โปรแกรมความเสี่ยง</h4>
  <?=Html::a('เลือก',['/rm/rm-group'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>
<div class="col-xs-3">
<div class="tile">
  <?= Html::img($baseUrl.'/icon-svg/document.svg',[
    'class' => 'tile-image big-illustration',
    'width' => 30
  ]);?>
  <h4 class="tile-title">ชื่อความเสี่ยง</h4>
  <?=Html::a('เลือก',['/rm/rm-items'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>

<div class="col-xs-3">
<div class="tile">
  <?= Html::img($baseUrl.'/icon-svg/high_priority.svg',[
    'class' => 'tile-image big-illustration',
    'width' => 30
  ]);?>
  <h4 class="tile-title">ระดับความรุนแรง</h4>
  <?=Html::a('เลือก',['/rm/rm-levelgroup'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>

<div class="col-xs-3">
<div class="tile">
  <?= Html::img($baseUrl.'/icon-svg/medium_priority.svg',[
    'class' => 'tile-image big-illustration',
    'width' => 30
  ]);?>
  <h4 class="tile-title">ระดับความเสี่ยง</h4>
  <?=Html::a('เลือก',['/rm/rm-level'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>
<div class="col-xs-3">
  <div class="tile">
    <?= Html::img($baseUrl.'/icon-svg/collaboration.svg',[
      'class' => 'tile-image big-illustration',
      'width' => 30
    ]);?>
    <h4 class="tile-title">Administration Error)</h4>

      ความคลาดเคลื่อนในการบริหารยา<br><br>

    <?=Html::a('เลือก',['/rm/administration-error'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
  </div>
</div>

<div class="col-xs-3">
<div class="tile">
<?= Html::img($baseUrl.'/icon-svg/fine_print.svg',[
  'class' => 'tile-image big-illustration',
  'width' => 30
]);?>
<h4 class="tile-title">Transcribing Error</h4>

  ความคลาดเคลื่อนในการคัดลอกคำสั่งใช้ยา

<?=Html::a('เลือก',['/rm/transcribing-error'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>
<div class="col-xs-3">
<div class="tile">
<?= Html::img($baseUrl.'/icon-svg/assistant.svg',[
  'class' => 'tile-image big-illustration',
  'width' => 30
]);?>
<h4 class="tile-title">Dispensing Error</h4>
ความคลาดเคลื่อนในการจ่ายยา
<br><br>
<?=Html::a('เลือก',['/rm/dispensing-error'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>

<div class="col-xs-3">
<div class="tile">
<?= Html::img($baseUrl.'/icon-svg/reading_ebook.svg',[
  'class' => 'tile-image big-illustration',
  'width' => 30
]);?>
<h4 class="tile-title">Prescription Error</h4>

  ความคลาดเคลื่อนในการสั่งใช้ยา
  <br><br>

<?=Html::a('เลือก',['/rm/prescription-error'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>

<div class="col-xs-3">
<div class="tile">
<?= Html::img($baseUrl.'/icon-svg/paid.svg',[
  'class' => 'tile-image big-illustration',
  'width' => 30
]);?>
<h4 class="tile-title">Pre Dispensing Error</h4>

  ความคลาดเคลื่อนในกระบวนการจัดยาก่อนจ่ายยา

<?=Html::a('เลือก',['/rm/pre-dispensing-error'],['class' => 'btn btn-primary btn-large glyphicon glyphicon-hand-up btn-block' ]) ?>
</div>
</div>



</div>
