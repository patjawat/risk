<?php

namespace risk\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User;
class RmEvent extends \yii\db\ActiveRecord
{
  const UPLOAD_FOLDER='rmevent';
  public  $date1;
  public  $date2;
  public $user_id;
  public $priority;
  public $comment;
  public $total;
  public $name;
  public $evelgroup_name;
    public static function tableName()
    {
        return 'rm_event';
    }
    public static function getDb()
    {
        return Yii::$app->get('risk');
    }
    public function rules()
    {
        return [
            [['ref', 'rm_level_id', 'rm_levelgroup_id', 'rm_items_id', 'rm_group_id', 'rm_workgroup_id', 'rm_type_id', 'rm_reporttype_id', 'rm_department_position_id', 'department_id', 'accident_id', 'event_date', 'report_date'], 'required'],
            [['ref', 'images', 'review'], 'string'],
            [['rm_items_id', 'rm_reporttype_id', 'rm_department_position_id', 'age', 'reporter'], 'integer'],
            [['rca_date', 'review_date', 'check_date', 'event_date', 'report_date', 'review_teme', 'created_at', 'delete', 'related', 'effect','drug_items_id','med_employee_id', 'urgent_id','date1','date2', 'editing_id','total','name','class','levelgroup_name'], 'safe'],
            [['rm_level_id', 'rm_levelgroup_id'], 'string', 'max' => 1],
            [['rm_group_id', 'rm_workgroup_id', 'accident_id', 'urgent_id', 'editing_id', 'prescription_laza', 'transcribing_laza', 'administration_laza', 'dispensing_laza', 'pre_dispensing_laza', 'lasa'], 'string', 'max' => 5],
            [['rm_type_id', 'rm_type_id1'], 'string', 'max' => 10],
            [['department_id'], 'string', 'max' => 50],
            [['accident_name', 'hn', 'an', 'wi_name'], 'string', 'max' => 45],
            [['rm_event_note', 'editing_note', 'prescription_error', 'pre_dispensing_error', 'transcribing_error', 'administration_error', 'dispensing_error', 'prescription_error_note', 'pre_dispensing_error_note', 'transcribing_error_note', 'administration_error_note', 'dispensing_error_note', 'wi', 'sp', 'sp_name', 'cpg_cnpg', 'cpg_cnpg_name'], 'string', 'max' => 255],
            [['prescription_name', 'prescription_name2', 'transcribing_name', 'administration_name', 'dispensing_name', 'pre_dispensing_man', 'pre_dispensing_check'], 'string', 'max' => 100],
            [['administration_type'], 'string', 'max' => 4],
            [['accident_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accident::className(), 'targetAttribute' => ['accident_id' => 'id']],
            [['editing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Editing::className(), 'targetAttribute' => ['editing_id' => 'id']],
            [['rm_department_position_id', 'department_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmDepartmentPosition::className(), 'targetAttribute' => ['rm_department_position_id' => 'id', 'department_id' => 'department_id']],
            [['rm_items_id', 'rm_group_id', 'rm_workgroup_id', 'rm_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmItems::className(), 'targetAttribute' => ['rm_items_id' => 'id', 'rm_group_id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id', 'rm_type_id' => 'rm_type_id']],
            [['rm_level_id', 'rm_levelgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmLevel::className(), 'targetAttribute' => ['rm_level_id' => 'id', 'rm_levelgroup_id' => 'rm_levelgroup_id']],
            [['rm_reporttype_id'], 'exist', 'skipOnError' => true, 'targetClass' => RmReporttype::className(), 'targetAttribute' => ['rm_reporttype_id' => 'id']],
            [['urgent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Urgent::className(), 'targetAttribute' => ['urgent_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'Ref',
            'rm_level_id' => 'ระดับความเสี่ยง',
            'rm_levelgroup_id' => 'ระดับความรุนแรง',
            'rm_items_id' => 'ชื่อความเสี่ยง',
            'rm_group_id' => 'โปรแกรมความเสี่ยง',
            'rm_workgroup_id' => 'ทีมคล่อม',
            'rm_type_id' => 'ประเภท',
            'rm_type_id1' => 'ประเภท',
            'rm_reporttype_id' => 'การรายงาน',
            'rm_department_position_id' => 'จุดเกิดเหตุ',
            'department_id' => 'หน่วยงานที่เกิดเหตุ',
            'rca_date' => 'ทำ RCA วันที่',
            'accident_id' => 'ผู้ประสบเหตุ',
            'urgent_id' => 'ความเร่งด่วน',
            'editing_id' => 'การแก้ไข',
            'review_date' => 'ส่งผลการทบทวนวันที่',
            'check_date' => 'วันที่ตรวจรับ',
            'event_date' => 'วันเกิดเหตุ',
            'report_date' => 'วันรายงาน',
            'accident_name' => 'ชื่อผู้ประสบเหตุ',
            'age' => 'อายุ',
            'hn' => 'Hn',
            'an' => 'An',
            'rm_event_note' => 'บรรยายเหตุการณ์โดยย่อ',
            'editing_note' => 'วิธีการแก้ปัญหาดังนี้',
            'reporter' => 'ผู้รายงาน',
            'related' => 'หน่วยงานที่เกี่ยวข้องกับเหตุการณ์',
            'images' => 'ภาพประกอบ',
            'review' => 'การทบทวน',
            'prescription_error' => 'ความคลาดเคลื่อนในการสั่งใช้ยา (Prescription Error)',
            'prescription_laza' => 'Laza',
            'prescription_name' => 'ผู้จัด',
            'prescription_name2' => 'ผู้ตรวจสอบ',
            'pre_dispensing_error' => 'ความคลาดเคลื่อนในกระบวนการจัดยาก่อนจ่ายยา (Pre-Dispensing Error)',
            'transcribing_error' => 'ความคลาดเคลื่อนในการคัดลอกคำสั่งใช้ยา (Transcribing Error)',
            'transcribing_laza' => 'laza',
            'transcribing_name' => 'ชื่อผู้คัดลอกคำสั่งใช้ยา',
            'administration_error' => 'ความคลาดเคลื่อนในการบริหารยา (Administration Error)',
            'administration_laza' => 'LAZA',
            'administration_type' => 'ประเภท',
            'administration_name' => 'ชื่อ',
            'dispensing_error' => 'ความคลาดเคลื่อนในการจ่ายยา (Dispensing Error)',
            'dispensing_laza' => 'Laza',
            'dispensing_name' => 'ผู้จ่าย',
            'prescription_error_note' => 'หมายเหตุ',
            'pre_dispensing_error_note' => 'หมายเหตุ',
            'transcribing_error_note' => 'หมายเหตุ',
            'administration_error_note' => 'หมายเหตุ',
            'dispensing_error_note' => 'หมายเหตุ',
            'pre_dispensing_laza' => 'Pre Dispensing Laza',
            'pre_dispensing_man' => 'ผู้จัด',
            'pre_dispensing_check' => 'ผู้ตรวจสอบ',
            'review_teme' => 'ทบทวนโดยทีม',
            'wi' => 'คู่มือปฏิบัติงาน',
            'wi_name' => 'ชื่อเรื่อง',
            'sp' => 'ระเบียบปฏิบัติงาน',
            'sp_name' => 'เรื่อง',
            'cpg_cnpg' => 'CPG,CNPG',
            'cpg_cnpg_name' => 'เรื่อง',
            'created_at' => 'Created At',
            'delete' => 'การแจ้งลบ',
            'effect' => 'ผลกระทบ',
            'laza' => 'ความคลาดเคลื่อนทางยา',
            'rmReporttype.name' => 'รายงานกับ',
            'rmDepartmentPosition.department.name' => 'แผนก-ฝ่าย',
              'rmDepartmentPosition.name' => 'จุดเกิดเหตุ',
              'accident.name' => 'ผู้ประสบเหตุ',
              'urgent.name' => 'ความแร่งด่วน',
              'editing.name' => 'การแก้ไข',
              'date1' => 'เริ่มต้น',
              'date2' => 'สิ้นสุด',
              'drug_items_id' => 'ชื่อยา',
              'multigroup' => 'โปรแกรมความเสี่ยง'
        ];
    }

    public function getUserreport()
    {
        return $this->hasOne(User::className(), ['id' => 'reporter']);
    }


    public function getAccident()
    {
        return $this->hasOne(Accident::className(), ['id' => 'accident_id']);
    }


    public function getEditing()
    {
        return $this->hasOne(Editing::className(), ['id' => 'editing_id']);
    }

    public function getRmDepartmentPosition()
    {
        return $this->hasOne(RmDepartmentPosition::className(), ['department_id' => 'rm_department_position_id', 'department_id' => 'department_id']);
    }

    public function getRmItems()
    {
        return $this->hasOne(RmItems::className(), ['id' => 'rm_items_id', 'rm_group_id' => 'rm_group_id', 'rm_workgroup_id' => 'rm_workgroup_id', 'rm_type_id' => 'rm_type_id']);
    }


    public function getRmLevel()
    {
        return $this->hasOne(RmLevel::className(), ['id' => 'rm_level_id', 'rm_levelgroup_id' => 'rm_levelgroup_id']);
    }
    public function getRmLevelgroup()
    {
        return $this->hasOne(RmLevelgroup::className(), ['id' => 'rm_levelgroup_id']);
    }
    public function getRmGroup()
    {
        return $this->hasOne(RmGroup::className(), ['id' => 'rm_group_id']);
    }


    public function getRmReporttype()
    {
        return $this->hasOne(RmReporttype::className(), ['id' => 'rm_reporttype_id']);
    }


    public function getUrgent()
    {
        return $this->hasOne(Urgent::className(), ['id' => 'urgent_id']);
    }


    public function getRmEventHasHows()
    {
        return $this->hasMany(RmEventHasHow::className(), ['rm_event_id' => 'id']);
    }


    public function getHows()
    {
        return $this->hasMany(RmHow::className(), ['id' => 'how_id'])->viaTable('rm_event_has_how', ['rm_event_id' => 'id']);
    }


    public function getRmEventHasResults()
    {
        return $this->hasMany(RmEventHasResult::className(), ['rm_event_id' => 'id']);
    }


    public function getRmResults()
    {
        return $this->hasMany(RmResult::className(), ['id' => 'rm_result_id'])->viaTable('rm_event_has_result', ['rm_event_id' => 'id']);
    }
    public static function find()
    {
        return new RmEventQuery(get_called_class());
    }


    public function Month($year){
$params= [':year' => $year];
$sql = "SELECT year(event_date) as y,month(event_date) as m,COUNT(id) as total,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 1 AND YEAR(event_date) =:year) as m1,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 2 AND YEAR(event_date) =:year) as m2,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 3 AND YEAR(event_date) =:year) as m3,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 4 AND YEAR(event_date) =:year) as m4,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 5 AND YEAR(event_date) =:year) as m5,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 6 AND YEAR(event_date) =:year) as m6,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 7 AND YEAR(event_date) =:year) as m7,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 8 AND YEAR(event_date) =:year) as m8,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 9 AND YEAR(event_date) =:year) as m9,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 10 AND YEAR(event_date) =:year) as m10,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 11 AND YEAR(event_date) =:year) as m11,
(SELECT COUNT(id) FROM rm_event WHERE MONTH(event_date) = 12 AND YEAR(event_date) =:year) as m12
FROM rm_event
WHERE YEAR(event_date) =:year";
$command = Yii::$app->risk->createCommand($sql,$params)->queryAll();
$data = "";
    foreach ($command as $model) {
      $data= [
                [
                  'ม.ค.',
                    $model['m1']*1
                ],
                [
                  'ก.พ.',
                    $model['m2']*1
                ],
                [
                  'มี.ค.',
                    $model['m3']*1
                ],
                [
                  'เม.ย.',
                    'y' => $model['m4']*1,
                    'drilldown' => [
               'type' => 'pie',
               'name'=> 'At Or Above the Poverty Line - Male',
               'data'=> [
                   ['Less Than High School<br />Graduate', 192156],
                   ['High School Diploma<br />Or Equivalent', 419101],
                   ['Some College<br />Or Associate\'s Degree', 314923],
                   ['Bachelor\'s Degree Or<br />Higher', 277128]
               ]
           ]
                ],
        [
            'พ.ค.',
            $model['m5']*1
        ],
        [
            'มิ.ย.',
            $model['m6']*1
        ],
        [
            'ก.ค.',
            $model['m7']*1
        ],
        [
            'ส.ค.',
            $model['m8']*1
        ],
        [
            'ก.ย.',
            $model['m9']*1
        ],
        [
            'ต.ค.',
            $model['m10']*1
        ],
        [
            'พ.ย.',
            $model['m11']*1
        ],
        [
            'ธ.ค.',
            $model['m12']*1
        ]
    ];
  }
  return $data;
}


            // ##############################
                     public static function getUploadPath(){
                         return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
                     }

                     public static function getUploadUrl(){
                         return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
                     }

                     public function getThumbnails($ref){
                          $uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
                          $preview = [];
                         foreach ($uploadFiles as $file) {
                             $preview[] = [
                                 'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                                 'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                                 'options' => ['title' => $file->file_name]
                             ];
                         }
                         return $preview;
                     }

                     public function initialPreview($data,$field,$type='file'){
                         $initial = [];
                         $files = Json::decode($data);
                         if(is_array($files)){
                              foreach ($files as $key => $value) {
                                 if($type=='file'){
                                     $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                                 }elseif($type=='config'){
                                     $initial[] = [
                                         'caption'=> $value,
                                         'width'  => '120px',
                                         'url'    => Url::to(['/rm-event/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                                         'key'    => $key
                                     ];
                                 }
                                 else{
                                     $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                                 }
                              }
                      }
                     return $initial;
                     }

                     public function listDownloadFiles($type){
                     $docs_file = '';
                     if(in_array($type, ['docs'])){

                          $data = $type==='docs'?$this->docs:$this->covenant;
                          $files = Json::decode($data);
                         if(is_array($files)){
                              $docs_file ='<ul>';
                              foreach ($files as $key => $value) {
                                 $docs_file .= '<li>'.Html::a($value,['/sitearticle/download','id'=>$this->id,'file'=>$key,'file_name'=>$value]).'</li>';
                              }
                              $docs_file .='</ul>';
                         }
                     }

                     return $docs_file;
                     }
                     public function actionDownload($id,$file,$file_name){
                     $model = $this->findModel($id);
                      if(!empty($model->ref) && !empty($model->docs)){
                             Yii::$app->response->sendFile($model->getUploadPath().'/'.$model->ref.'/'.$file,$file_name);
                     }else{
                         $this->redirect(['/site-article/view','id'=>$id]);
                     }
                     }


                     // ###############################



                     public function TranscribingError($model){
           //return Json::decode($model);

                           $json =  Json::decode($model);
                           if ($json > 0) {
                             $data ='';
                             foreach ($json as $key => $value) {
                               $data .= '<li><a> '.TranscribingError::find()->where(['id' => $value])->one()->name.'</a></li>';
                             }
                             $data .='';
                             return $data;
                           } else {
                             return '<span class="label label-success">ไม่พบความผิดพลาด</span> <li><a></span>';
                           }

                     }
                     public function AdministrationError($model){
                       $json =  Json::decode($model);
                       if ($json > 0) {
                         $data ='';
                         foreach ($json as $key => $value) {
                           $data .= '<li><a> '.AdministrationError::find()->where(['id' => $value])->one()->name.'</li></a>';
                         }
                         $data .='';
                         return $data;
                       } else {
                         return '<span class="label label-success">ไม่พบความผิดพลาด</span> <li><a></span>';
                       }
                     }

                     public function AdministrationErrorNote($model){
                       if($model !==""){
                         return '** หมายเหตุ<br>'.$model;
                       }else {
                         return '';
                       }
                     }

                     public function DispensingError($model){
                       $json =  Json::decode($model);
                       if ($json > 0) {
                         $data ='';
                         foreach ($json as $key => $value) {
                           $data .= '<li><a> '.DispensingError::find()->where(['id' => $value])->one()->name.'</li></a>';
                         }
                         $data .='';
                         return $data;
                       } else {
                         return '<span class="label label-success">ไม่พบความผิดพลาด</span> <li><a></span>';
                       }
                     }

                     public function DispensingerrorNote($model){
                       if($model !==""){
                         return '** หมายเหตุ<br>'.$model;
                       }else {
                         return '';
                       }
                     }
                     public function PredispensingError($model){
                       $json =  Json::decode($model);
                       if ($json > 0) {
                         $data ='';
                         foreach ($json as $key => $value) {
                           $data .= '<li><a> '.PreDispensingError::find()->where(['id' => $value])->one()->name.'</li></a>';
                         }
                         $data .='';
                         return $data;
                       } else {
                         return '<span class="label label-success">ไม่พบความผิดพลาด</span> <li><a></span>';
                       }
                     }
                     public function PredispensingErrornNote($model){
                       if($model !==""){
                         return '** หมายเหตุ<br>'.$model;
                       }else {
                         return '';
                       }
                     }

                     public function PrescriptionError($model){
                       $json =  Json::decode($model);
                       if ($json > 0) {
                         $data ='';
                         foreach ($json as $key => $value) {
                           $data .= '<li><a> '.PrescriptionError::find()->where(['id' => $value])->one()->name.'</li></a>';
                         }
                         $data .='';
                         return $data;
                       } else {
                         return '<span class="label label-success">ไม่พบความผิดพลาด</span> <li><a></span>';
                       }
                     }
                     public function PrescriptionErrorNote($model){
                       if($model !==""){
                         return '** หมายเหตุ<br>'.$model;
                       }else {
                         return '';
                       }
                     }

                     public function DateFormat($datetime){

                      //  $d = explode('/99/', $model[0].$model[1]);//แยก ปี-เดือน-วัน
                      //  $m = explode('/', $model[3].$model[4]);
                      //  $y = explode('/', $model[5].$model[6].$model[7].$model[8].$model[9]);
                       //
                      //  return $year = (int) $d;
                      return $yearfull = date('Y')+543;

                     }

                     public function DispensingCount($type,$level,$date1,$date2){
                       $sql = "SELECT COUNT(id) as total FROM rm_event
                                WHERE event_date BETWEEN '.$date1.' AND '.$date2.'
                                AND dispensing_error like CONCAT('%".$type."%')
                                AND rm_type_id = 'RM03'
                                AND rm_level_id = '.$level.'";
                          $query  =   Yii::$app->db->createCommand($sql)->queryAll();
                     return $query;
                     }


        public function DateTo($date){
             $get_date = explode("/","$date"); //แยกวันที่
             $date_time = explode(" เวลา ","$date"); //แยกวเวลา
             $d =$get_date["0"]; //วัน0
             $m = $get_date["1"]; //เดื0อน
             $y = $get_date["2"]; // ปี
             $y1 = $y-543;
             $time = substr($date_time['1'],0,6);
             return   $y1.'-'.$m.'-'.$d; //ส่งค่าวันที่กับเวลากลับ
             // $time = substr($date_time['1'],0,-3);

               // $y1.'-'.$m.'-'.$d; //ส่งค่าวันที่กลับ
           }
           public function DateFrom($date){
             $get_date = explode("-","$date"); //แยกวันที่
             $date_time = explode(" ","$date"); //แยกวเวลา
             $get_date["2"];
             //echo substr($get_date["2"],0,2);
             $y =$get_date["0"]; //วัน
             $m = $get_date["1"]; //เดือน
           // $d = $get_date["2"]; // ปี
             $d =  substr($get_date["2"],0,2);
             $y1 = $y+543;
             $time = substr($date_time["1"],0,5);
            $time = substr($date_time['1'],0,6);
           return $d.'/'.$m.'/'.$y1; //ส่งค่ากลับ
           }
           public function DatetimeTo($date){
                $get_date = explode("/","$date"); //แยกวันที่
                $date_time = explode(" เวลา ","$date"); //แยกวเวลา
                $d =$get_date["0"]; //วัน0
                $m = $get_date["1"]; //เดื0อน
                $y = $get_date["2"]; // ปี
                $y1 = $y-543;
                $time = substr($date_time['1'],0,6);
                return   $y1.'-'.$m.'-'.$d.' '.$time.':'.'00'; //ส่งค่าวันที่กับเวลากลับ
                // $time = substr($date_time['1'],0,-3);

                  // $y1.'-'.$m.'-'.$d; //ส่งค่าวันที่กลับ
              }
          //     public function DatetimeFrom($date){
          //       $get_date = explode("-","$date"); //แยกวันที่
          //       $date_time = explode(" ","$date"); //แยกวเวลา
          //       $get_date["2"];
          //       //echo substr($get_date["2"],0,2);
          //       $y =$get_date["0"]; //วัน
          //       $m = $get_date["1"]; //เดือน
          //     // $d = $get_date["2"]; // ปี
          //       $d =  substr($get_date["2"],0,2);
          //       $y1 = $y+543;
          //       $time = substr($date_time["1"],0,5);
          //      $time = substr($date_time['1'],0,6);
          //     return $d.'/'.$m.'/'.$y1.' เวลา '.$time.'00'; //ส่งค่ากลับ
          //     }
          //  public function DatetimeToThai($date){
          //    $get_date = explode("-","$date"); //แยกวันที่
          //    $date_time = explode(" ","$date"); //แยกวเวลา
          //    $get_date["2"];
          //    //echo substr($get_date["2"],0,2);
          //    $y =$get_date["0"]; //วัน
          //    $m = $get_date["1"]; //เดือน
          //  // $d = $get_date["2"]; // ปี
          //    $d =  substr($get_date["2"],0,2);
          //    $y1 = $y+543;
          //    $time = substr($date_time["1"],0,5);
          //   $time = substr($date_time['1'],0,6);
          //  return '<span class="glyphicon glyphicon-calendar"></span>'.
          //         $d.'/'.$m.'/'.$y1.' <span class="glyphicon glyphicon-time"></span> '.$time.'00'; //ส่งค่ากลับ
          //  }

           public function DatetimeTodb($date){
             //input yyyy/m/d
             $get_date = explode("/","$date"); //แยกวันที่
             $date_time = explode(" ","$date"); //แยกวเวลา
             $m = $get_date["1"]; //เดือน
             $d = $get_date['0'];
            $y =  substr($get_date["2"],0,4);
            $time = substr($date_time["1"],0,5);
          return  $y.'-'.$m.'-'.$d.' '.$time;
           }
               public function DatetimeFromdb($date){
                 //input yyyy-m-d
                 $get_date = explode("-","$date"); //แยกวันที่
                 $date_time = explode(" ","$date"); //แยกวเวลา
                 $get_date["2"];
                 //echo substr($get_date["2"],0,2);
                 $y =$get_date["0"]; //วัน
                 $m = $get_date["1"]; //เดือน
               // $d = $get_date["2"]; // ปี
                 $d =  substr($get_date["2"],0,2);
                 $y1 = $y+543;
                 $time = substr($date_time["1"],0,5);
              //  $time = substr($date_time['1'],0,6);
               return $d.'/'.$m.'/'.$y.' '.$time; //ส่งค่ากลับ
               }


               public function Rightwrong($model){
                   //$model = [];
                 foreach (json_decode($model) as $key => $value) {
                   $model = [
                     $value->right = ['name']
                   ];
                      //$value->wrong;
                 }
                 //eturn json_encode($model);
                return $model;
               }

               public function Dilldown($id,$date1,$date2){
                 $params = [':id' => $id,':date1' => $date1,':date2' => $date2];
                 $sql = "SELECT i.id as id,i.name,COUNT(e.id) as total FROM rm_event e
                          LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
                          LEFT OUTER JOIN rm_items i ON i.id = rm_items_id
                          WHERE DATE(e.event_date) BETWEEN :date1 AND :date2
                          AND g.id  = :id
                          GROUP BY i.id";
                  $query = Yii::$app->risk->createCommand($sql,$params)->queryAll();
                  $data = [];
                  foreach ($query as $model) {
                    $data[]  = [$model['name'], $model['total']*1];
                  }
                return $data;
               }
               public function Dilldownall($id){
                 $params = [':id' => $id];
                 $sql = "SELECT g.id as gid,g.name as gname,i.name as iname,COUNT(e.id) as y FROM rm_event e
                        LEFT OUTER JOIN rm_group g ON g.id = e.rm_group_id
                        LEFT OUTER JOIN rm_items i ON i.id = e.rm_items_id
                        WHERE e.rm_group_id = :id
                        GROUP BY i.id";
                  $query = Yii::$app->risk->createCommand($sql,$params)->queryAll();
                  $data = [];
                  foreach ($query as $model) {
                    $data[]  = [$model['iname'], $model['y']*1];
                  }
                return $data;
               }



        public function CountAll(){  // ทั้งหมด
          return RmEvent::find()->count();
        }
        public function CountEditing1(){// ำด้รับการแก้ไข
          return RmEvent::find()->where(['editing_id' => 1])->count();
        }
        public function CountEditing2(){//ยังไม่แก้ไข
          return RmEvent::find()->where(['editing_id' => 2])->count();
        }


    }
