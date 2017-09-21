<?php
use yii\helpers\Html;
use yii\helpers\Url;
 ?>
<style media="screen">
a{
  color:#6C7A89 ;
}
body{
background-color:#F2F1EF ;

}
.nav-tabs>li>a {
  color: #e6e6e6;
}
.nav-tabs>li>a:hover {
  background-color:#19B5FE;
  color: #FFFFFF;

}

.nav-tabs>li {
  margin-bottom: 0;
  border-left: 1px solid #E6E9ED;
  background-color:#AAB2BD;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
  background-color: #CCD1D9   !important;
  border: none;
  color: #FFFFFF;
}
.bs-glyphicons li {
    font-size: 12px;
    width: 12.5%;
    background-color: #f9f9f9;
    border: 1px solid #fff;
    float: left;
    height: 115px;
    line-height: 1.4;
    padding: 10px;
    text-align: center;
}
ul, menu, dir {
    display: block;
    list-style-type: disc;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    -webkit-padding-start: 40px;
}
.bs-glyphicons-list {
    list-style: none outside none;
}

</style>
<ul id="myTab1" class="nav nav-tabs">
  <li class="active"><a href="<?=Url::to('index.php?r=rm/setting');?>" >ระบบหลัก</a></li>
  <li class=""><a href="<?=Url::to('index.php?r=rm/rm-group');?>" >Profile</a></li>
  <li class="dropdown">
              <a href="#" id="myTabDrop1-1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                <li><a href="#dropdown1-1" tabindex="-1" data-toggle="tab">@fat</a></li>
  <li><a href="#dropdown1-2" tabindex="-1" data-toggle="tab">@mdo</a></li>
</ul>
</li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="home1">
