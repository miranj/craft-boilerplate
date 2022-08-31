<?php
/**
 * Yii Application Config for *only* web requests
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and config/app.php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 */

use craft\helpers\App;

return [
    // Global settings
    '*' => [],

    // Dev environment
    'dev' => [],

    // Production environment
    'production' => [
        'components' => [
            'session' => function () {
                // Get the default component config
                $config = App::sessionConfig();

                // Override the class to use Redis' session class
                $config['class'] = yii\redis\Session::class;

                // Instantiate and return it
                return Craft::createObject($config);
            },
        ],
    ],
];
