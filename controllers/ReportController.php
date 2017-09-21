<?php

namespace risk\controllers;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\data\ArrayDataProvider;
use risk\models\Department;
use risk\models\RmLevel;
use risk\models\AdministrationError;
use risk\models\DispensingError;
use risk\models\PreDispensingError;
use risk\models\TranscribingError;
use risk\models\PrescriptionError;
use risk\models\RmGroup;
use risk\models\RmGroupSearch;
use risk\models\RmItems;
use risk\models\RmItemsSearch;
use risk\models\RmEvent;
use risk\models\RmEventSearch;
use yii\helpers\Json;

class ReportController extends \yii\web\Controller
{

    public function actionIndex(){
      $searchModel = new RmEventSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      return $this->render('index',[
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
      ]);

    }
    public function actionEvent(){
      $searchModel = new RmEventSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $dataProvider->query->groupby('rm_items_id');
            return $this->render('event', [
                      'searchModel' => $searchModel,
                      'dataProvider' => $dataProvider,
                  ]);
    }
    public function actionPdfExport(){

      $searchModel = new RmEventSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['IN', 'rm_event.rm_group_id', $searchModel->multigroup]);
      $dataProvider->query->groupby('rm_event.rm_group_id');
      return $this->render('pdf', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,

       ]);


   }

   public function actionTest($date1,$date2){
     $searchModel = new RmEventSearch();
     $searchModel->date1 = $date1;
     $searchModel->date2 = $date2;
     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->query->andFilterWhere(['IN', 'rm_event.rm_group_id', $searchModel->multigroup]);
     $dataProvider->query->groupby('rm_event.rm_group_id');
     $content = $this->renderPartial('pdf1', [
       'searchModel' => $searchModel,
       'dataProvider' => $dataProvider,

      ]);

     $pdf = new Pdf([ 'mode' => Pdf::MODE_UTF8, // A4 paper format
    'format' => Pdf::FORMAT_A4, // portrait orientation
    'marginLeft' => 5,
    'marginRight' => 5,
    'marginTop' => 5,
    'marginBottom' => 5,
    'marginHeader' => false,
    'marginFooter' => false,

    // 'orientation' => Pdf::ORIENT_PORTRAIT, // stream to browser inline
    'orientation' => Pdf::ORIENT_LANDSCAPE, // stream to browser inline
    'destination' => Pdf::DEST_BROWSER, // your html content input
    'content' => $content, // format content from your own css file if needed or use the // enhanced bootstrap css built by Krajee for mPDF formatting
    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css', // any css to be embedded if required
    'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}', // set mPDF properties on the fly
    'options' => ['title' => 'Preview Report Case: '], // call mPDF methods on the fly
    'methods' => [
      //'SetHeader'=>[''],
       //'SetFooter'=>['{PAGENO}'],
     ]
      ]);

     //$pdf = Yii::$app->pdf; // or new Pdf();
$mpdf = $pdf->api; // fetches mpdf api
$mpdf->SetHeader('Kartik Header'); // call methods or set any properties
$mpdf->WriteHtml($content); // call mpdf write html
echo $mpdf->Output('filename', 'D'); // call the mpdf api output as needed
   }

   public function actionTest2(){
     $content = $this->renderPartial('pdf', [
       'searchModel' => $searchModel,
       'dataProvider' => $dataProvider,

      ]);

   //  setup kartik\mpdf\Pdf
      $pdf = new Pdf([ 'mode' => Pdf::MODE_UTF8, // A4 paper format
     'format' => Pdf::FORMAT_A4, // portrait orientation
     'marginLeft' => 5,
     'marginRight' => 5,
     'marginTop' => 5,
     'marginBottom' => 5,
     'marginHeader' => false,
     'marginFooter' => false,

     // 'orientation' => Pdf::ORIENT_PORTRAIT, // stream to browser inline
     'orientation' => Pdf::ORIENT_LANDSCAPE, // stream to browser inline
     'destination' => Pdf::DEST_BROWSER, // your html content input
     'content' => $content, // format content from your own css file if needed or use the // enhanced bootstrap css built by Krajee for mPDF formatting
     'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css', // any css to be embedded if required
     'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}', // set mPDF properties on the fly
     'options' => ['title' => 'Preview Report Case: '], // call mPDF methods on the fly
     'methods' => [
       //'SetHeader'=>[''],
        //'SetFooter'=>['{PAGENO}'],
      ]
       ]);
     //   $mpdf = $pdf->api; // fetches mpdf api
     //   $mpdf->SetHeader('Kartik Header'); // call methods or set any properties
     //   $mpdf->WriteHtml($content); // call mpdf write html
     // return  $mpdf->Output('filename', 'D'); // call the mpdf api output as needed

      return $pdf->render();


   }



}
