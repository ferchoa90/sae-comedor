<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'bootstrap' => ['gii'],
    
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '192.168.100.101', '192.168.100.7'],
            'generators' => [
                    'crud' => [
                        'class' => 'yii\gii\generators\crud\Generator',
                        'templates' => [
                            'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                        ]
                    ]
                ]
                        ],
            'gridview' => ['class' => 'kartik\grid\Module']
        // ...
    ],
    
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
                ],
            ],
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
        /*'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
            ],
       ],*/
       'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            '' => 'site/index',                                
            '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
        ],
    ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        
    ],
    'params' => $params,
];

