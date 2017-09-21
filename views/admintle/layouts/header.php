<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
 <style media="screen">
  @import url('https://fonts.googleapis.com/css?family=Kanit:200,400|PT+Sans|PT+Serif');
   @font-face {
       font-family: sukhumvitset-bold;
       src: url('fonts/sukhumvitset-text-webfont.ttf');
   }
   body {
       /*font-family: 'Kanit', sans-serif;*/
   }
   h1,h2,h3,h4,h5 {
       /*font-family: sukhumvitset-bold;*/
      font-family: 'Kanit', sans-serif;
   }
   strong{
     /*font-family: sukhumvitset-bold;*/
   }
   .sidebar-menu{
      font-family: sukhumvitset-bold;
   }
   .logo-header{
       margin-left:45%;
       margin-right: 35%;
       padding-bottom: 1%;
   }
   .p-title{
     text-align: center;
     font-size: 20px;
   }
   .header-title{
     font-size: 20px;
   }

 </style>
    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg ion-ios-medkit">โปรแกรมความเสี่ยง#</span>', Yii::$app->homeUrl.'?r=rm', ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">1</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">การแจ้งซ่อม 1 รายการ</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                <?php if (Yii::$app->user->isGuest) : ?>

                    <li><a href="<?=Url::to('index.php?r=user/security/login ');?>" class="ion-android-lock "></span>เข้าสู่ระบบ</a></li>


                  <?php else: ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- <img src="<?php //$directoryAsset ?>/img/user2-160x160.jpg" class="user-image ion-android-contact" alt="User Image"/> -->
                          <img  src="<?php // $directoryAsset ?>images/user-512.png" class="img-circle"alt="User Image" style="width:15px;background-color:#ffffff;"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->profile->name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <!-- <img src="<?php // $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"alt="User Image"/> -->
                            <img src="<?php // $directoryAsset ?>images/user-512.png" class="img-circle"alt="User Image"/>
                            <p><?=Yii::$app->user->identity->profile->name; ?></p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?=Url::to('index.php?r=user/settings/profile');?>" class="btn btn-primary ion-android-contact">ข้อมูลส่วนตัว</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'ออกจากระบบ',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-danger ion-power']
                                ) ?>
                            </div>
                        </li>
                    </ul>



                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
