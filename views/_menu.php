  <?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="pull-left">
  <?php
      echo Html::a('หน้าหลัก', ['/rm/default'], ['class' => 'btn btn-info  glyphicon glyphicon-home']).'&nbsp';
      echo Html::a('อุบัติการณ์ความเสี่ยง', ['/rm/rm-event'], ['class' => 'btn btn-primary   glyphicon glyphicon-pencil']).'&nbsp';
      echo Html::button('สรุปงาน', ['value' => Url::to(['rm-event/endjob']),'type'=>'button', 'title'=>'<span class="glyphicon glyphicon-calendar"></span>เลือกวันที่และประมวลผล', 'class'=>'showModalButton btn btn-success glyphicon glyphicon-print']);
      Html::button('Update Company', ['value' => Url::to(['rm-event/update', 'id'=>'RM021','group' =>22]), 'title' => 'Updating Company', 'class' => 'showModalButton btn btn-success']);
      ?>
      <div class="btn-group">
      <button type="button" class="btn glyphicon glyphicon-cog">ตั้งค่า</button>
      <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
      <span class="caret"></span>
      <span class="sr-only">Toggle Dropdown</span>
      </button>
        <ul class="dropdown-menu" role="menu">
            <li><?= Html::a('เหตุการร์-อุบัติการณ์', ['/rm/rm-items'], ['class' => 'glyphicon glyphicon-ok'])?></li>
            <li><?= Html::a('กลุ่มความเสี่ยง', ['/rm/rm-group'], ['class' => ' glyphicon glyphicon-ok'])?></li>
            <li><?= Html::a('กลุ่มงาน', ['/rm/rm-workgroup'], ['class' => ' glyphicon glyphicon-ok'])?></li>
            <li><?= Html::a('แผนก-ฝ่าย', ['/rm/rm-department'], ['class' => ' glyphicon glyphicon-ok'])?></li>
            <li class="divider"></li>
            <li><?= Html::a('ผู้ใช้งาน', ['/rm/user'], ['class' => 'glyphicon glyphicon-user'])?></li>
        </ul>
    </div>
</div>
<br><br>
