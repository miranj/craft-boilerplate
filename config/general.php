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
        'useProjectConfigFile' => true,
        'allowAdminChanges' => false,
        'allowUpdates' => false,
        'usePathInfo' => true,
        'enableGql' => false,
        'securityKey' => App::env('SECURITY_KEY'),
        
        // user sessions
        'phpSessionName' => App::env('APP_ID').'CraftSessionId',
        'csrfTokenName' => App::env('APP_ID').'_CSRF',
        'requireMatchingUserAgentForSession' => false,
        'rememberedUserSessionDuration' => 'P1M',
        'userSessionDuration' => 'P1M',
        
        // control panel
        'timezone' => 'Asia/Kolkata',
        'defaultWeekStartDay' => '1',
        'defaultCpLanguage' => 'en-GB',
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
        'errorTemplatePrefix' => "_errors/",
        'pageTrigger' => 'page/',
        
        // content
        'maxRevisions' => 10,
        'maxUploadFileSize' => '100M',
        
        'aliases' => [
            '@web' => App::env('DEFAULT_SITE_URL'),
            '@assetBaseUrl' => App::env('ASSET_BASE_URL'),
            '@assetBasePath' => App::env('ASSET_BASE_PATH'),
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
        'disabledPlugins' => ['inventory', 'cp-field-inspect', 'environment-label'],
        'runQueueAutomatically' => false,
    ],
];
