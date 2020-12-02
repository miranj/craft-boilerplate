<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

return [
    // Global settings
    '*' => [
        
        // back-end
        'useProjectConfigFile' => true,
        'allowAdminChanges' => false,
        'usePathInfo' => true,
        'enableGql' => false,
        'securityKey' => getenv('SECURITY_KEY'),
        
        // user sessions
        'phpSessionName' => getenv('SITE_SLUG').'CraftSessionId',
        'csrfTokenName' => getenv('SITE_SLUG').'_CSRF',
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
        'sendPoweredByHeader' => false,
        'defaultImageQuality' => 85,
        'errorTemplatePrefix' => "_errors/",
        'pageTrigger' => 'page/',
        
        // content
        'maxRevisions' => 10,
        'maxUploadFileSize' => '100M',
        
        'aliases' => [
            '@web' => getenv('DEFAULT_SITE_URL'),
            '@assetBaseUrl' => getenv('ASSET_BASE_URL'),
            '@assetBasePath' => getenv('ASSET_BASE_PATH'),
        ],
    ],
    
    
    
    // Dev environment
    'dev' => [
        'devMode' => true,
        'enableTemplateCaching' => false,
        'allowAdminChanges' => true,
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
        'disabledPlugins' => ['inventory', 'cp-field-inspect', 'environment-label'],
        'runQueueAutomatically' => false,
    ],
];
