<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;

return [
    // Global settings
    '*' => [
        // back-end
        'allowAdminChanges' => false,
        'allowUpdates' => false,
        'usePathInfo' => true,
        'enableGql' => false,

        // user sessions
        'phpSessionName' => App::env('CRAFT_APP_ID') . 'CraftSessionId',
        'csrfTokenName' => App::env('CRAFT_APP_ID') . '_CSRF',
        'requireMatchingUserAgentForSession' => false,
        'rememberedUserSessionDuration' => 'P1M',
        'userSessionDuration' => 'P1M',

        // control panel
        'timezone' => 'Asia/Kolkata',
        'defaultWeekStartDay' => '1',
        'defaultCpLanguage' => 'en-GB',
        'baseCpUrl' => App::env('CRAFT_DEFAULT_SITE_URL'),
        'defaultSearchTermOptions' => [
            'subLeft' => true,
            'subRight' => true,
        ],

        // front-end
        'omitScriptNameInUrls' => true,
        'disallowRobots' => true,
        'sendPoweredByHeader' => false,
        'convertFilenamesToAscii' => true,
        'defaultImageQuality' => 85,
        'defaultTemplateExtensions' => ['twig'],
        'errorTemplatePrefix' => '_errors/',
        'pageTrigger' => 'page/',

        // content
        'maxRevisions' => 50,
        'maxUploadFileSize' => '100M',

        'aliases' => [
            '@web' => App::env('CRAFT_DEFAULT_SITE_URL'),
            '@assetBaseUrl' => App::env('CRAFT_ASSET_BASE_URL'),
            '@assetBasePath' => App::env('CRAFT_ASSET_BASE_PATH'),
            '@contentBasePath' =>
                App::env('CRAFT_CONTENT_BASE_PATH') ?: '@root/content',
        ],
    ],

    // Dev environment
    'dev' => [
        'devMode' => true,
        'enableTemplateCaching' => false,
        'allowAdminChanges' => true,
        'allowUpdates' => true,
        'maxBackups' => false,
    ],

    // Staging environment
    'staging' => [
        'devMode' => false,
        'disabledPlugins' => ['inventory', 'cp-field-inspect'],
    ],

    // Production environment
    'production' => [
        'devMode' => false,
        'disallowRobots' => false,
        'disabledPlugins' => [
            'inventory',
            'cp-field-inspect',
            'environment-label',
        ],
        'runQueueAutomatically' => false,
    ],
];
