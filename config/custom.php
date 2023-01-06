<?php
/**
 * Custom Configuration
 *
 * https://craftcms.com/docs/4.x/config/#custom-settings
 */

use craft\helpers\App;

return [
    // Global settings
    '*' => [
        'enableGoogleAnalytics' => !!App::env('GOOGLE_ANALYTICS_ID'),
    ],

    // Dev environment
    'dev' => [],

    // Staging environment
    'staging' => [],

    // Production environment
    'production' => [
        'enableGoogleAnalytics' => true,
    ],
];
