<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 *
 * Read more about application configuration:
 * https://craftcms.com/docs/5.x/reference/config/app.html
 */

use craft\helpers\App;

return [
    // Global settings
    '*' => [
        'id' => App::env('CRAFT_APP_ID') ?: 'CraftCMS',

        'modules' => [
            'boilerplate' => \boilerplate\Module::class,
        ],
        'bootstrap' => ['boilerplate'],
    ],

    // Dev environment
    'dev' => [
        'components' => [
            'deprecator' => [
                'throwExceptions' => true,
            ],
        ],
    ],

    // Production environment
    'production' => [
        'components' => [
            'redis' => [
                'class' => yii\redis\Connection::class,
                'hostname' => App::env('REDIS_HOSTNAME') ?: 'localhost',
                'password' => App::env('REDIS_PASSWORD') ?: null,
            ],
            'cache' => fn() => Craft::createObject([
                'class' => yii\redis\Cache::class,
                'keyPrefix' => Craft::$app->id,
                'defaultDuration' =>
                    Craft::$app->config->general->cacheDuration,
                'redis' => [
                    'database' => 1,
                ],
            ]),
        ],
    ],
];
