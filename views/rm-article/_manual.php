<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
// use yii\grid\GridView;
 ?>
<h2 class="glyphicon glyphicon-book">คู่มือการใช้งาน</h2>
<div class="panel panel-primary">
                        <div class="panel-heading">
                          <h3 class="panel-title">คู่มือการใช้งาน</h3>
                        </div>
                        <div class="panel-body">
                          <?php
                          echo GridView::widget([
                              'dataProvider' => $dataProvider,
                             //'filterModel' => $searchModel,
                              'id' => 'idofyourpjaxwidget',
                              'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'name',
                                    'format' => 'raw',
                                    'value' => function($model,$url) {
                                        //return $model->name;
                                        return  Html::a($model->name, ['/rm/rm-article/view', 'id' => $model->id]);
                                    },
                                    //'header' => 'ประเภท',
                                    // 'vAlign' => 'middle',
                                     //'width' => '600px',
                                ],

                              //  ['class' => 'yii\grid\ActionColumn'],
                              ],
                          ]);
                           ?>
                        </div>
                      </div>
