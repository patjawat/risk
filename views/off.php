<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="glyphicon glyphicon-cog" ></i>&nbsp;
              สถานะการทำงาน
            </div>
            <div class="panel-body" style="height:380px;">
                <h1 class="text-center "><span class=" glyphicon glyphicon-time" style="padding-top:70px;color:#2ABB9B""></span>ยังไม่มีการประมวลผล</h1>
                <h3 class="text-center"><span class="glyphicon glyphicon-ok" style="color:#2ABB9B"></span> เลือกข้อมูลเพื่อทำการประมวลผล</h3>
                <h3 class="text-center " id="datetime"> </h3>
              </div>
          </div>
        </div>
      </div>

      <?php
      //$js = <<< JS
      //JS;
      $this->registerJs("$(function(){
      // วันเวลา
      setInterval(function(){
      $.ajax({
      url:'index.php?r=rm/default/date-time',
      success:function(data){
          $('#datetime').html(data);
      }
      });
      }, 500);
      //จบ


    });");
      ?>
