<?php
namespace risk\views;
use yii\web\AssetBundle;
class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
      //'flot/jquery.flot.pie.min.js'
      //  'datatables/dataTables.bootstrap.min.js',
        // more plugin Js here
       'flot/jquery.flot.js',
       'flot/jquery.flot.resize.min.js',
       'flot/jquery.flot.pie.min.js',
       'flot/jquery.flot.categories.min.js',
       'morris/morris.min.js',
       'fastclick/fastclick.js',
       
    ];
    public $css = [
        'datatables/dataTables.bootstrap.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
};

 ?>
