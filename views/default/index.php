<?php
use kartik\helpers\Html;
use yii\helpers\Url;

use yii\grid\GridView;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use risk\models\RmEvent;
use risk\models\RmArticle;
$event = new RmEvent();
$all = RmEvent::find()->count();
$non = RmEvent::find()->where(['rm_type_id' => 'non-clinic'])->count();
$clinic = RmEvent::find()->where(['rm_type_id' => 'clinic'])->count();
$edit = RmEvent::find()->where(['editing_id' => 2])->count();
$formatter = \Yii::$app->formatter;
$this->title = "RM Manager | บริหารจัดการความเสี่ยงภายในองค์กร";
?>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><span class="glyphicon glyphicon-tasks"></span>โปรแกรมบริการจัดการความเสี่ยง โรงพยาบาลโนนสัง</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-7">
        <section class="section-white">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                <img src="http://placehold.it/1200x500" alt="...">
                <div class="carousel-caption">
                  <h2>Heading</h2>
                </div>
              </div>
              <div class="item">
                <img src="http://placehold.it/1200x500" alt="...">
                <div class="carousel-caption">
                  <h2>Heading</h2>
                </div>
              </div>
              <div class="item">
                <img src="http://placehold.it/1200x500" alt="...">
                <div class="carousel-caption">
                  <h2>Heading</h2>
                </div>
              </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </section>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-5">

        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">อุบัติการณ์ความเสี่ยงที่เกิดขึ้นทั้งหมด</span>
            <span class="info-box-number">
              <?php echo $all; ?> ครั้ง
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: 12%"></div>
            </div>
            <span class="progress-description">
              <?php echo $formatter->asPercent($all/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">อุบัติการณ์ที่เป็นความเสี่ยงทั่วไป</span>
            <span class="info-box-number">
              <?php echo $non;?> ครั้ง
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: 53%"></div>
            </div>
            <span class="progress-description">
              <?php echo $formatter->asPercent($non/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">อุบัติการณ์ที่เป็นความเสี่ยงทางคลินิก</span>
            <span class="info-box-number">
              <?php echo $clinic;?> ครั้ง
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: 16%"></div>
            </div>
            <span class="progress-description">
              <?php echo $formatter->asPercent($clinic/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

        <div class="info-box bg-gray">
          <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">อุบัติการณ์ที่ยังไม่ดำเนินการแก้ไข</span>
            <span class="info-box-number">
              <?php echo $edit;?> รายการ
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: 17%"></div>
            </div>
            <span class="progress-description">
              <?php echo $formatter->asPercent($edit/($non+$clinic+$edit+$all),2);?> ของจำนวนทั้งหมด
            </span>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-mf-12 col-sm-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Tab 1</a></li>
        <li><a href="#tab_2-2" data-toggle="tab">Tab 2</a></li>
        <li><a href="#tab_3-2" data-toggle="tab">Tab 3</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            Dropdown <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
          </ul>
        </li>
        <li class="pull-left header"><i class="fa fa-th"></i> แสดงรายการ</li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">แสดงอุบัติการณ์ความเสี่ยงที่เกิดขึ้น</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
              echo  $this->render('rm_event', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
              ]);
              ?>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <?= Html::a('<span class="glyphicon glyphicon-list"></span> ดูทั้งหมด', ['/rm/rm-event'], ['class' => 'btn btn-sm btn-info btn-flat pull-left']) ?>
                <?php // Html::a('<span class="glyphicon glyphicon-list"></span> ดูทั้งหมด', ['/rm/rm-event'], ['class' => 'btn btn-sm btn-default btn-flat pull-rigth']) ?>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2-2">
          The European languages are members of the same family. Their separate existence is a myth.
          For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
          in their grammar, their pronunciation and their most common words. Everyone realizes why a
          new common language would be desirable: one could refuse to pay expensive translators. To
          achieve this, it would be necessary to have uniform grammar, pronunciation and more common
          words. If several languages coalesce, the grammar of the resulting language is more simple
          and regular than that of the individual languages.
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3-2">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
          when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          It has survived not only five centuries, but also the leap into electronic typesetting,
          remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
          sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
          like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>

<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number">1,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bookmarks</span>
              <span class="info-box-number">410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Uploads</span>
              <span class="info-box-number">13,648</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">93,139</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bookmarks</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Events</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Comments</span>
              <span class="info-box-number">41,410</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
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
