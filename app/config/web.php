<?php

$params = require __DIR__ . '/params.php';
/*$db = require __DIR__ . '/db.php';*/
$db = file_exists(__DIR__.'/db_local.php')?(require __DIR__.'/db_local.php'):(require __DIR__.'/db.php');

$config = [
    'id' => 'basic',
    'language' => 'ru_RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bcnv19tgguBu5dC9MzLQmEkpDmhAzoZ_',
        ],
        'activity' => [
            'class' => \app\components\ActivityComponent::class,
            'activity_class' => '\app\models\Activity'
        ],
        'day' => [
            'class' => \app\components\DayComponent::class,
            'day_class' => 'app\models\Day'
        ],
        'dao' => \app\components\DaoComponent::class,
        'auth' => \app\components\UserAuthComponent::class,
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
        ],
        'rbac' => \app\components\RbacComponent::class,
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget', //в файл
                    'categories' => ['activity_create'], //категория логов
                    'logFile' => '@runtime/logs/activity_create.log', //куда сохранять
                    'logVars' => [] //не добавлять в лог глобальные переменные ($_SERVER, $_SESSION...)
                ],
            ],
        ],
        'db' => $db,
        'viewFormatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php: d.m.Y'
        ],
        'sqlFormatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php: Y-m-d'
        ],
        'headersFormatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php: j F Y'
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ]

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
