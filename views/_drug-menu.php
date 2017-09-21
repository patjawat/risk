<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
?>
                      <div class="list-group">
                        <a href="#" class="list-group-item active glyphicon glyphicon-th-list">เมนูหลัก</a>
                        <?= Html::a('ความคลาดเคลื่อนในการบริหารยา', ['/rm/administration-error'], ['class' => 'glyphicon glyphicon-ok list-group-item']) ?>
                        <?= Html::a('ความคลาดเคลื่อนในการคัดลอกคำสั่งใช้ยา', ['/rm/transcribing-error'], ['class' => 'glyphicon glyphicon-ok list-group-item']) ?>
                        <?= Html::a('ความคลาดเคลื่อนในกระบวนการจัดยาก่อนจ่ายยา', ['/rm/pre-dispensing-error'], ['class' => 'glyphicon glyphicon-ok list-group-item']) ?>
                        <?= Html::a('ความคลาดเคลื่อนในการสั่งใช้ยา', ['/rm/prescription-error'], ['class' => 'glyphicon glyphicon-ok list-group-item']) ?>
                        <?= Html::a('ความคลาดเคลื่อนในการจ่ายยา', ['/rm/dispensing-error'], ['class' => 'glyphicon glyphicon-ok list-group-item']) ?>
                      </div>
