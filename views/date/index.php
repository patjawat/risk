<?php
/* @var $this yii\web\View */
?>
<h1>date/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use kartik\growl\Growl;
 ?>


<?php if(Yii::$app->session->hasFlash('alert')):?>
<?php 


echo Growl::widget([
    'type' => Growl::TYPE_SUCCESS,
    'icon' => 'glyphicon glyphicon-ok-sign',
    'title' => 'สถานะการทำงาน',
    'showSeparator' => true,
    'body' => 'ประมวลผลเสร็จสมบรูณ์'
]);
?>



<?php endif; ?>

 <?php $form = ActiveForm::begin([
       // 'action' => ['department'],
        'method' => 'post',
    ]); ?>
 
    <div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'date1')->widget(DatePicker::ClassName(),
    [
    'name' => 'check_issue_date', 
    'options' => ['placeholder' => 'Select date ...'],
    'pluginOptions' => [

        'format' => 'dd/mm/yyyy',
        'todayHighlight' => true
    ]
]);?>
    </div>
    <div class="col-md-3">
        
        <?= $form->field($model, 'date2')->widget(DatePicker::ClassName(),
    [
    'name' => 'check_issue_date', 
    'options' => ['placeholder' => 'Select date ...'],
    'pluginOptions' => [

        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
    ]
]);?>
    </div>

    
    <div class="col-md-3">
    	<div class="form-group" style="padding-top:25px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        <?= Html::resetButton('พิมพ์', ['class' => 'btn btn-default glyphicon glyphicon-file']) ?>
    </div>
    </div>
    
</div>

    <?php ActiveForm::end(); ?>



	


    <div class="panel panel-success">
                        <div class="panel-heading">
                          <h3 class="panel-title"> <span class="glyphicon glyphicon-time"></span>การแสดงผล !!</h3>
                        </div>
                        <div class="panel-body">
<table class="table table-bordered table-hover">




</table>
</div>
</div>



