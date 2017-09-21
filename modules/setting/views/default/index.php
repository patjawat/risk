<?php
use yii\helpers\Url;
?>
<div class="setting-default-index">
    <h1>การตั้งค่าผู้ใช้งานระบบ</h1>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
<style>
a >.box-link{
     background-color: #fff;
}
.feature-box {
    background-color: #fff;
    border: 1px solid #e3e3e3;
    border-radius: 3px;
    margin-bottom: 15px;
    min-height: 20px;
    padding: 19px;
    text-align: center;
}
.feature-icon i {
    font-size: 50px;
}
font-awesome.min.css:4
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    transform: translate(0, 0);
}
.feature-box:hover {
    background-color: rgba(0, 132, 180, 0.21);
    border: 1px solid #e3e3e3;
    color: #959fae;
}
</style>
<div class="inner-content">
                    <div class="panel theme-panel">
                        <div class="panel-heading">
                            <span class="panel-title">
								ตั้งค่าผู้ใช้งานระบบ <i class="fa fa-user"></i>
							</span>
                        </div>
                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-3 column">
                                <a href="<?=Url::to(['/user/admin/index']);?>" class="box-link">
                                    <div class="feature-box">
                                        <span class="feature-icon"><i class="fa fa-user"></i></span>
                                        <h4>ตั้งค่าผู้ใช้งานระบบ </h4>
                                        <span>One code used for all device</span>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-3 column">
                                <a href="<?=Url::to(['/admin/route']);?>" class="box-link">
                                    <div class="feature-box">
                                        <span class="feature-icon"><i class="fa fa-tasks"></i></span>
                                        <h4>สิทธิการเข้าใช้งานระบบ</h4>
                                        <span>Desktops, Tablets and Mobile</span>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-3 column">
                                <a href="<?=Url::to(['/admin/permission']);?>" class="box-link">
                                    <div class="feature-box">
                                        <span class="feature-icon"><i class="fa fa-random"></i></span>
                                        <h4>เส้นทางการเข้าถึง </h4>
                                        <span>Minimized Menu on Toggle</span>
                                    </div>
                                     </a>
                                </div>
                                <div class="col-md-3 column">
                                <a href="<?=Url::to(['/admin/role']);?>" class="box-link">
                                    <div class="feature-box">
                                        <span class="feature-icon"><i class="fa fa-thumbs-up"></i></span>
                                        <h4>บทบาท</h4>
                                        <span>4 level SubMenu added</span>
                                    </div>
                                </div>
                                 </a>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-3 column">
                                <a href="<?=Url::to(['/admin/assignment']);?>" class="box-link">
                                    <div class="feature-box">
                                        <span class="feature-icon"><i class="fa fa-link"></i></span>
                                        <h4>การมอบหมาย</h4>
                                        <span>Using Minified CSS File </span>
                                    </div>
                                </div>
                                 </a>
                                
                            
                        </div>
                    </div>
                </div>
                 </div>
<?php
$js = <<< JS

$(function(){ //โหลดหน้าเว็บ
     $('.box-link').click(function(){
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