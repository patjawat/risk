<?php

$config = [
    'components' => [
         'risk' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mariadb;dbname=risk_new',
            'username' => 'root',
            'password' => 'docker',
            'charset' => 'utf8',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'N0DJtkBDvvdG-tuqcDTnO4wkLOZuLNXE',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
