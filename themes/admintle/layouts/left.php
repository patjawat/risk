
<?php
use common\models\AuthAssignment;
\timurmelnikov\widgets\LoadingOverlayAsset::register($this);
?>
<?php $itemname = AuthAssignment::find()->where(["user_id" => Yii::$app->user->id])->one()->item_name; ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <?php if (!Yii::$app->user->isGuest) : ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => $itemname, 'options' => ['class' => 'header']],
                    ['label' => 'หน้าหลัก', 'icon' => 'home', 'url' => ['/risk']],
                    ['label' => 'บันทึกความเสี่ยง', 'icon' => 'edit', 'url' => ['/rm-event/create']],
                    ['label' => 'ค้นหาความเสี่ยง', 'icon' => 'search', 'url' => ['/rm-event']],
                    //['label' => 'ตั้งค่า', 'icon' => 'glyphicon glyphicon-tasks', 'url' => ['/setting']],
                    // ['label' => 'ลงทะเบียนเข้าใช้งาน', 'icon' => 'user', 'url' => ['/user/registration/register']],
                    [
                        'label' => 'รายงาน',
                        'icon' => 'print',
                        'url' => '#',
                        'items' => [
                            ['label' => 'รายงานอุบัติการความเสี่ยง', 'icon' => 'fa fa-circle-o', 'url' => ['/report/index'],],
                        ],
                    ],
                  ['label' => 'เกี่ยวกับโปรแกรม', 'icon' => 'comment', 'url' => ['/risk/about'],],

                ],
            ]
        ) ?>

      <?php endif; ?>
    <?php if (!Yii::$app->user->isGuest): ?>

    <?php if($itemname == "RiskManager"):?> <!--ถ้าอยู่ในกลุ่มผู้ดูแลระบบ (Admin) ให้แสเงเมนูส่วนนี้-->

        <?= dmstr\widgets\Menu::widget(
[
    'options' => ['class' => 'sidebar-menu'],
    'items' => [

        [
            'label' => 'ตั้งค่าระบบ',
            'icon' => 'cog',
            'url' => '#',
            'items' => [
                [
                    'label' => 'ตั้งค่าแผนก/ฝ่าย',
                    'icon' => 'sort-desc',
                    'url' => '#',
                    'items' => [
                        ['label' => 'แผนกฝ่าย', 'icon' => 'arrow-right', 'url' => ['/department'],],
                        ['label' => 'จุดเกิดเหตุ', 'icon' => 'arrow-right', 'url' => ['/rm-department-position'],],
                    ],
                ],
                [
                    'label' => 'ตั้งค่าความเสี่ยง',
                    'icon' => 'sort-desc',
                    'url' => '#',
                    'items' => [
                        ['label' => 'ทีมคล่อม', 'icon' => 'arrow-right', 'url' => ['/rm-workgroup'],],
                        ['label' => 'โปรแกรความเสี่ยง', 'icon' => 'arrow-right', 'url' => ['/rm-group'],],
                        ['label' => 'ระดับความรุนแรง', 'icon' => 'arrow-right', 'url' => ['/rm-level'],],
                        ['label' => 'รายชื่อความเสี่ยง', 'icon' => 'arrow-right', 'url' => ['/rm-items'],],
                    ],
                ],
                [
                    'label' => 'ตั้งค่าความคลาดเคลื่อนทางยา',
                    'icon' => 'sort-desc',
                    'url' => '#',
                    'items' => [
                        ['label' => 'รายการยา', 'icon' => 'arrow-right', 'url' => ['/drug-items'],],
                        ['label' => 'เจ้าหน้าที่จ่ายยา', 'icon' => 'arrow-right', 'url' => ['/med-employee'],],
                        ['label' => 'PrescriptionError', 'icon' => 'arrow-right', 'url' => ['/prescription-error'],],
                        ['label' => 'PreDispensingError', 'icon' => 'arrow-right', 'url' => ['/pre-dispensing-error'],],
                        ['label' => 'TanscribingError', 'icon' => 'arrow-right', 'url' => ['/transcribing-error'],],
                        ['label' => 'DispensingError', 'icon' => 'arrow-right', 'url' => ['/dispensing-error'],],
                        ['label' => 'AdministrationError', 'icon' => 'arrow-right', 'url' => ['/administration-error'],],
                    ],
                ],

            ],
        ],

      //  ['label' => 'ทีมพัฒนา', 'icon' => 'ion-android-contacts', 'url' => ['/em/team/shows']],
        //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    ],
]
) ?>



<?php endif;?>
<?php endif; ?>
    </section>

</aside>
<?php
$js = <<< JS
$(function(){ //โหลดหน้าเว็บ
     $('.sidebar-menu>li>a').click(function(){
         if($(this).attr('href')!=='#'){
            $("body").LoadingOverlay("show");
         }
    });
     $("body").LoadingOverlay("hide");
});

// จบการโหลดหน้าเว็บ****

// โหลด pjax
 $.LoadingOverlaySetup({
        color           : "rgba(0, 0, 0, 0.4)",
        maxSize         : "80px",
        minSize         : "20px",
        resizeInterval  : 0,
        size            : "50%"
    });
$('#pjax-container').on('pjax:send', function() {
   $("body").LoadingOverlay("show");
 })
$('#pjax-container').on('pjax:complete', function() {
    $("body").LoadingOverlay("hide");
 })
$('#pjax-container').on('pjax:timeout', function(event) { event.preventDefault(); })
// จบ Pjax****
JS;
$this->registerJS($js);
?>
