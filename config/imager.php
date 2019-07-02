<?php

/**
 * Configuration file for Imager
 *
 * Multi-environment settings work in this file the same way as in general.php or db.php
 */

return [
    // Global settings
    '*' => [
        'imagerSystemPath' => '@assetBasePath/imager/',
        'imagerUrl' => '@assetBaseUrl/imager/',

        'jpegQuality' => 85,
        'allowUpscale' => false,
        'interlace' => 'plane',
        'removeMetadata' => true,
        'cacheDuration' => 60*60*24*365*10, // 10 years

        'useCwebp' => true,
        'cwebpPath' => '/usr/bin/cwebp',

        'optimizerConfig' => [
            'jpegoptim' => [
                'optionString' => '-s -m85 -T1',
                'extensions' => ['jpg'],
                'path' => '/usr/bin/jpegoptim',
            ],
            'optipng' => [
                'extensions' => ['png'],
                'path' => '/usr/bin/optipng',
                'optionString' => '-o2',
            ],
        ],

    //    'clearKey' => '',
    ],


    // Production
    'production' => [
        'optimizers' => ['jpegoptim', 'optipng'],
    ],

    // Staging
    'staging' => [
        'optimizers' => ['jpegoptim', 'optipng'],
    ],

    // Dev
    'dev' => [
        'hashPath' => true,
        'filenamePattern' => '{fullname}.{extension}',
        'useCwebp' => getenv('IMAGER_CWEBP_PATH') ?: false,
        'cwebpPath' => getenv('IMAGER_CWEBP_PATH'),
    ],

];
