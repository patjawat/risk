<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;


?>

<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>

        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; โรงพยาบาลโนนสัง อ.โนนสัง จ.หนองบัวลำภู <a href="http://nonsang.moph.go.th">http://nonsnag.moph.go.th</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <aside class="main-sidebar">
          <section class="sidebar">

            <?php if(!Yii::$app->user->isGuest): ?>


              <?= dmstr\widgets\Menu::widget(
                  [
                      'options' => ['class' => 'sidebar-menu'],
                      'items' => [
                          ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                          ['label' => 'ประชาสัมพันธ์', 'icon' => 'ion-speakerphone', 'url' => ['/em/post/']],
                          ['label' => 'กิจกรรม', 'icon' => 'ion-ribbon-b', 'url' => ['/em/news/']],
                          ['label' => 'ทะเบียนผู้ใช้งาน', 'icon' => 'ion-person-add', 'url' => ['/user/admin']],
                          [
                              'label' => 'สิทธิการใช้งานระบบ',
                              'icon' => 'ion-person-stalker',
                              'url' => '#',
                              'items' => [
                                  ['label' => 'กลุ่มผู้ใช้งาน', 'icon' => 'ion-ios-people', 'url' => ['/admin/role'],],
                                  ['label' => 'เส้นทาง', 'icon' => 'ion-ios-shuffle-strong', 'url' => ['/admin/route'],],
                                  ['label' => 'จัดการสิทธิ', 'icon' => 'ion-clipboard', 'url' => ['/admin/assignment']],

                              ],
                          ],
                          //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                      ],
                  ]
              ) ?>
  <?php endif; ?>
          </section>

      </aside>

        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>


            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
xxxxx

        </div>
        <!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
