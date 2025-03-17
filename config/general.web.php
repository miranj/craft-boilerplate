<?php
/**
 * General (Web) Configuration
 *
 * General configuration values specific to web (HTTP) requests.
 * https://craftcms.com/docs/5.x/configure.html#application-types
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;
use craft\config\GeneralConfig;

return function (GeneralConfig $config) {
    $manifestFile = dirname(__DIR__) . '/web/build/manifest.json';
    $manifest = file_exists($manifestFile)
        ? json_decode(file_get_contents($manifestFile), true)
        : [];

    return $config->cpHeadTags([
        [
            'link',
            [
                'rel' => 'stylesheet',
                'href' =>
                    rtrim(App::env('PRIMARY_SITE_URL'), '/') .
                    '/build/craftcp.' .
                    ($manifest['craftcp.css'] ?? '1') .
                    '.css',
            ],
        ],
    ]);
};
