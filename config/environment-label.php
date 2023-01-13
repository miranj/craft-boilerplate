<?php

/**
 * Configuration settings for Environment Label plugin
 * https://github.com/TopShelfCraft/Environment-Label
 *
 *   'showLabel' => true,
 *   'labelText' => CRAFT_ENVIRONMENT,
 *   'prefixText' => null,
 *   'suffixText' => null,
 *   'labelColor' => '#cc5643',
 *   'textColor' => '#ffffff',
 *
 */

use craft\helpers\App;

return [
    '*' => [
        'labelText' => ucfirst(App::env('CRAFT_ENVIRONMENT')),
        'suffixText' => ' environment',
    ],

    'production' => [
        'showLabel' => false,
    ],

    'staging' => [
        'labelColor' => 'orange',
    ],

    'dev' => [
        'labelColor' => 'skyblue',
    ],
];
