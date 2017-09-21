<?php
use dektrium\user\controllers\SecurityController;
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-risk',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'risk\controllers',
    'defaultRoute' => 'rm-event',
    'modules' => [
      //dektrium
           'user' => [
                  'class' => 'dektrium\user\Module',
                  'enableUnconfirmedLogin' => false,
                  'enableRegistration' => false, //การอนุญาติให้สมัครเข้าใช้ระบบ
                  'enableConfirmation' => false,
                  'confirmWithin' => 21600,
                  'cost' => 12,
                  'admins' => ['admin'],

              ],
              //End dektrium
              //RBAC Manager
                      'admin' => [
                      'class' => 'mdm\admin\Module',
                      //'layout' => 'left-menu',
                      'controllerMap' => [

                      'assignment' => [
                      'class' => 'mdm\admin\controllers\AssignmentController',
                       'userClassName' => 'dektrium\user\models\User', //เรียกใช้โมเดล user ของ dektrium
                     ]
                   ],
              ],
              //End RBAC Manager
              'profile' => [
                       'class' => 'backend\modules\profile\Profile',
                   ],

        //ตัวจัดการ  text Editer
              'redactor' => [
                         'class' => 'yii\redactor\RedactorModule',
                         'uploadDir' => '@webroot/post',
                         'uploadUrl' => '@web/post',
                         'imageAllowExtensions'=>['jpg','jpeg','png','gif']
                     ],
                        'roxymce'  => [
			'class' => '\phamxuanloc\roxymce\Module',
			'config'=> [
			//all below is not required
				'FILES_ROOT'           => 'uploads/image', //The root directory of roxymce's resource, where can be uploaded to. if not existed, Roxy will auto create
				'DEFAULTVIEW'          => 'list', //default view when you call roxymce (thumb/list)
				'THUMBS_VIEW_WIDTH'    => '100', //default width of thumbs when thumb view activated
				'THUMBS_VIEW_HEIGHT'   => '100', //default height of thumbs when thumb view activated
				'MAX_IMAGE_WIDTH'      => '1000', //default maximum width of image allowed to upload
				'MAX_IMAGE_HEIGHT'     => '1000', //default maximum height of image allowed to upload
				'FORBIDDEN_UPLOADS'    => 'zip js jsp jsb mhtml mht xhtml xht php phtml php3 php4 php5 phps shtml jhtml pl sh py cgi exe application gadget hta cpl msc jar vb jse ws wsf wsc wsh ps1 ps2 psc1 psc2 msh msh1 msh2 inf reg scf msp scr dll msi vbs bat com pif cmd vxd cpl htpasswd htaccess', //default forbidden upload files extension
				'ALLOWED_UPLOADS'      => 'jpeg jpg png gif mov mp3 mp4 avi wmv flv mpeg', //default allowed upload files extension
				'FILEPERMISSIONS'      => '0644', //default file permissions
				'DIRPERMISSIONS'       => '0755', //default folder permissions
				'LANG'                 => 'en', //fix language interface. if NOT SET, language interface will auto follow Yii::$app->language
				'DATEFORMAT'           => 'dd/MM/yyyy HH:mm', //default datetime format
				'OPEN_LAST_DIR'        => 'yes', //default roxymce will open last dir where you leave
			]
		],

                      'social' => [
                       // the module class
                       'class' => 'kartik\social\Module',
                       'facebook' => [
                           'appId' => 'FACEBOOK_APP_ID',
                           'secret' => 'FACEBOOK_APP_SECRET',
                       ],
                   ],
                   // your other modules


// Module Gii

  'setting' => [
                                'class' => 'risk\modules\setting\Setting',
                            ],
                            'content' => [
                                'class' => 'risk\modules\content\Content',
                            ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-risk',
        ],
        'view' => [
          'theme' => [
            'pathMap' => [
              //  '@app/views' => '@frontend/themes/admintle',
              '@app/views' => '@risk/themes/admintle',
            ],
          ],
        ],
        'assetManager' => [
          'class'=>'yii\web\AssetManager',
       'bundles' => [
           'edgardmessias\assets\nprogress\NProgressAsset' => [
               'configuration' => [
                   'minimum' => 0.08,
                   'showSpinner' => true,
               ],
               'page_loading' => true,
               'pjax_events' => true,
               'jquery_ajax_events' => false,
           ],
          // --- Admin LTE Widget
           'insolita\wgadminlte\ExtAdminlteAsset'=>[
                         'depends'=>[
                             'yii\web\YiiAsset',
                             'path\to\AdminLteAsset',
                             'insolita\wgadminlte\JsCookieAsset'
                         ]
                     ],
                     'insolita\wgadminlte\JsCookieAsset'=>[
                           'depends'=>[
                               'yii\web\YiiAsset',
                               'path\to\AdminLteAsset'
                          ]
                     ],
          // End Admin LTE------------
       ],
   ],

        'user' => [
            //'identityClass' => 'common\models\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-risk', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the risk
            'name' => 'advanced-risk',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // 'authManager' => [
        //             'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        //         ]

    ],

    'controllerMap' => [
            'elfinder' => [
                'class' => 'mihaildev\elfinder\Controller',
                'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
                'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
                'roots' => [
                    [
                        'baseUrl'=>'@web',
                        'basePath'=>'@webroot',
                        'path' => 'files/global',
                        'name' => 'Global'
                    ],
                    [
                        'class' => 'mihaildev\elfinder\volume\UserPath',
                        'path'  => 'files/user_{id}',
                        'name'  => 'My Documents'
                    ],
                    // [
                    //     'path'  => 'files/user_'.Yii::$app->user->id,
                    //     'name' => ['category' => 'user_'.Yii::$app->user->id,'message' => 'Some Name'] //перевод Yii::t($category, $message)
                    // ],
                    // [
                    //     'path'   => 'files/some',
                    //     'name'   => ['category' => 'user_'.Yii::$app->user->id,'message' => 'Some Name'], // Yii::t($category, $message)
                    //     'access' => ['read' => '*', 'write' => 'UserFilesAccess'] // * - для всех, иначе проверка доступа в даааном примере все могут видет а редактировать могут пользователи только с правами UserFilesAccess
                    // ]
                ],
                'watermark' => [
                		'source'         => __DIR__.'/logo.png', // Path to Water mark image
                         'marginRight'    => 5,          // Margin right pixel
                         'marginBottom'   => 5,          // Margin bottom pixel
                         'quality'        => 95,         // JPEG image save quality
                         'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                         'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                         'targetMinPixel' => 200         // Target image minimum pixel size
                ]
            ]
        ],


    'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
      // '*',
        'debug*',
         'user/security/logout',
         'datecontrol*',
         'profile/user/register',
        //  'risk*',
        //  'med-items*'

    ]
],
    'params' => $params,
];
