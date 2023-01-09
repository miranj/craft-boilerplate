<?php

/**
 * Configuration file for Imager
 *
 * Multi-environment settings work in this file the same way as in general.php or db.php
 */

use craft\helpers\App;
use craft\helpers\ArrayHelper;

$defaultCustomEncoders = [
    'webp' => [
        'path' => '/usr/bin/cwebp',
        'options' => [
            'quality' => 80,
            'effort' => 4,
        ],
        'paramsString' => '-q {quality} -m {effort} {src} -o {dest}',
    ],
];

return [
    // Global settings
    '*' => [
        'imagerSystemPath' => '@assetBasePath/images/x',
        'imagerUrl' => '@assetBaseUrl/images/x',

        'jpegQuality' => 85,
        'allowUpscale' => false,
        'interlace' => 'plane',
        'removeMetadata' => true,
        'cacheDuration' => 60 * 60 * 24 * 365 * 10, // 10 years

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

        // 'clearKey' => '',
    ],

    // Production
    'production' => [
        'optimizers' => ['jpegoptim', 'optipng'],
        'customEncoders' => $defaultCustomEncoders,
    ],

    // Staging
    'staging' => [
        'optimizers' => ['jpegoptim', 'optipng'],
        'customEncoders' => $defaultCustomEncoders,
    ],

    // Dev
    'dev' => [
        'hashPath' => true,
        'filenamePattern' => '{fullname}.{extension}',
        'customEncoders' => App::env('IMAGER_CWEBP_PATH')
            ? ArrayHelper::merge($defaultCustomEncoders, [
                'webp' => [
                    'path' => App::env('IMAGER_CWEBP_PATH'),
                ],
            ])
            : [],
    ],
];
