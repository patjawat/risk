<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'การแจ้งเตือนจากระบบ';
?>

<div class="rows">
  <div class="col-lg-10 col-lg-offset-1">
<div class="panel panel-danger" style="height:350px; margin-top:50px;margin-bottom:125px;">
                        <div class="panel-heading">
                          <h3 class="panel-title"><span class="glyphicon glyphicon-minus-sign"></span> <?php echo $this->title; ?></h3>
                        </div>
                        <div class="panel-body">
                          <h1 class="text-center">ไม่อนุญาติให้ใช้งาน <span style="color:#C91F37">!!</span></h1>
                          <h3 class="text-center"> <span class="glyphicon glyphicon-user"></span> ติดต่อผู้ดูแลระบบ</h3>
                          <hr>
                          <div class="text-center"><?php  echo \yii\helpers\Html::a( 'ย้อนกลับ', Yii::$app->request->referrer,['class' =>'btn btn-danger  glyphicon glyphicon-arrow-left']); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

<br><br><br><br><br><br><br><br><br>
