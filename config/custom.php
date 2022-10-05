<?php
/**
 * Custom Configuration
 *
 * https://craftcms.com/docs/4.x/config/#custom-settings
 */

return [
    // Global settings
    '*' => [
        'enableGoogleAnalytics' => false,
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
