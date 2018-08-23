<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 21/6/2016
 * Time: 5:30 PM
 */
$params = require(__DIR__ . '/../../config/params.php');

$config = [
    'id' => 'api',
    'basePath' => dirname(__DIR__) . '/..',
    'bootstrap' => ['log'],
    'components' => [
        // URL Configuration for our API
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'fproject\rest\UrlRule',
                    'controller' => [
                        'v1/baocaokiemtra',
                        'v1/baocaobaohiemxahoi',
                        'v1/quyetdinhkiemtra',
                        'v1/quyetdinhxuly',
                        'v1/nguoinopthue',
                        'v1/truongdoankiemtra',
                        'v1/lichsunopsaukiemtra',
                        'v1/sotheodoisauhoanthue',
                        'v1/quyetdinhthuhoihoanthue',
                        'v1/baocaothanhtra',
                        'v1/quyetdinhtruythu',
                        'v1/quyetdinhthanhtra',
                        'v1/lichsunopthanhtra',
                        'v1/quyetdinhxuphat',
                        'v1/vanbanhoanthue'
                    ],
                ],
                [
                    'class' => 'app\api\modules\v1\helpers\UrlRule',
                    'controller' => [
                        'v1/baocaobaohiemxahoitheonam'
                    ],
                ],
            ],
        ],
        'request' => [
            // Set Parser to JsonParser to accept Json in request
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // Set this enable authentication in our API
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false, // Don't forget to set Auto login to false
        ],
        // Enable logging for API in a api Directory different than web directory
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    // maintain api logs in api directory
                    'logFile' => '@api/runtime/logs/error.log'
                ],
            ],
        ],
        'db' => require(__DIR__ . '/../../config/db.php'),
        'response' => [
            'class' => 'yii\web\Response',
            'formatters' => [
                'dateFormat' => [
                    'class' => 'yii\i18n\Formatter',
                    'dateFormat' => 'dd-MM-yyyy',
                    'datetimeFormat' => 'dd-MM-yyyy',
                    'timeFormat' => 'HH:mm:ss',
                ]
            ],
        ],
    ],
    'modules' => [
        'v1' => [
            'basePath' => '@app/api/modules/v1',
            'class' => 'app\api\modules\v1\Api',
        ]
    ],
    'params' => $params,
];

return $config;