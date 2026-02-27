<?php
/**
 * Custom Configuration
 *
 * https://craftcms.com/docs/4.x/config/#custom-settings
 */

use craft\helpers\App;
use yii\caching\FileDependency;

$environment = strtolower(App::env('CRAFT_ENVIRONMENT'));
$isDev = $environment === 'dev';

function getFileContentsAsJson(string $filePathOrAlias)
{
    return \Craft::$app
        ->getCache()
        ->getOrSet(
            [__FILE__, __FUNCTION__, $filePathOrAlias],
            fn() => json_decode(
                file_get_contents(\Craft::getAlias($filePathOrAlias)),
                true,
            ),
            null,
            new FileDependency(['fileName' => $filePathOrAlias]),
        );
}

return [
    // Global settings
    '*' => [
        'enableGoogleAnalytics' => !!App::env('GOOGLE_ANALYTICS_ID'),
        'useYouTubeFacadeLoading' => false, // add 'lite-youtube.js' to `buildScripts` if `true`

        // Build stylesheets & scripts
        'buildStylesheets' => [$isDev ? 'style.css' : 'style.purged.min.css'],
        'buildScripts' => [
            'urgent.min.js' => 'async',
            'deferred.min.js' => 'async',
            'instant.min.js' => 'module',
            'photoswipeinit.min.js' => 'module',
            // 'lite-youtube.js' => 'module', // enable if `useYouTubeFacadeLoading` is `true`
        ],

        // Build manifest helpers
        'getBuildManifest' => fn($buildFile) => getFileContentsAsJson(
            '@assetBasePath/build/manifest.json',
        )[$buildFile] ?? '',
        'getBuildManifestSri' => fn($buildFile) => getFileContentsAsJson(
            '@assetBasePath/build/manifest-sri.json',
        )[$buildFile] ?? '',

        // <head>
        'headLinkTags' => [
            // [
            //     'rel' => 'preconnect',
            //     'href' => 'https://fonts.gstatic.com',
            //     'crossorigin' => true,
            // ],
        ],

        // External stylesheets
        'externalStylesheets' => [
            // [
            //     'href' =>
            //         'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i&display=swap',
            //     'async' => true,
            // ],
        ],
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
