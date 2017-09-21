<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <?php if (!Yii::$app->user->isGuest) : ?>
          <div class="user-panel">
              <div class="pull-left image">
                <img src="<?php // $directoryAsset ?>images/user-512.png" class="img-circle"alt="User Image" style="background-color:#ffffff;"/>
                  <!-- <img src="<?php // $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/> -->
              </div>
              <div class="pull-left info">
                  <p><?=Yii::$app->user->identity->profile->name; ?></p>

                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
          </div>
        <?php endif; ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'MainMenu', 'options' => ['class' => 'header']],
                    ['label' => 'หน้าหลัก', 'icon' => 'glyphicon glyphicon-home', 'url' => ['/rm']],
                    ['label' => 'บันทึกความเสี่ยง', 'icon' => 'glyphicon glyphicon-edit', 'url' => ['/rm/rm-event/create']],
                    ['label' => 'ค้นหาความเสี่ยง', 'icon' => 'ion-android-search', 'url' => ['/rm/rm-event']],
                    //['label' => 'ตั้งค่า', 'icon' => 'glyphicon glyphicon-tasks', 'url' => ['/rm/setting']],
                    ['label' => 'ลงทะเบียนเข้าใช้งาน', 'icon' => 'ion-person-add', 'url' => ['/user/registration/register']],
                    [
                        'label' => 'รายงาน',
                        'icon' => 'glyphicon glyphicon-tasks',
                        'url' => '#',
                        'items' => [
                            ['label' => 'รายงานอุบัติการความเสี่ยง', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/report/pdf-export'],],
                        ],
                    ],
                    [
                        'label' => 'ตั้งค่าระบบ',
                        'icon' => 'glyphicon glyphicon-tasks',
                        'url' => '#',
                        'items' => [
                          //  ['label' => 'แผนก/ฝ่าย', 'icon' => 'glyphicon glyphicon-folder-close', 'url' => ['/rm/department'],],
                            [
                                'label' => 'ตั้งค่าแผนก/ฝ่าย',
                                'icon' => 'glyphicon glyphicon-folder-close',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'แผนกฝ่าย', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/department'],],
                                    ['label' => 'จุดเกิดเหตุ', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/rm-department-position'],],
                                ],
                            ],
                            [
                                'label' => 'ตั้งค่าความเสี่ยง',
                                'icon' => 'glyphicon glyphicon-folder-open',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'ทีมคล่อม', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/rm-workgroup'],],
                                    ['label' => 'โปรแกรความเสี่ยง', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/rm-group'],],
                                    ['label' => 'ระดับความรุนแรง', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/rm-level'],],
                                    ['label' => 'รายชื่อความเสี่ยง', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/rm-items'],],
                                ],
                            ],
                            [
                                'label' => 'ตั้งค่าความคลาดเคลื่อนทางยา',
                                'icon' => 'glyphicon glyphicon-folder-open',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'รายการยา', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/drug-items'],],
                                    ['label' => 'PrescriptionError', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/prescription-error'],],
                                    ['label' => 'TanscribingError', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/transcribing-error'],],
                                    ['label' => 'DispensingError', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/dispensing-error'],],
                                    ['label' => 'AdministrationError', 'icon' => 'fa fa-circle-o', 'url' => ['/rm/administration-error'],],
                                ],
                            ],

                        ],
                    ],
                  //  ['label' => 'ทีมพัฒนา', 'icon' => 'ion-android-contacts', 'url' => ['/em/team/shows']],
                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
