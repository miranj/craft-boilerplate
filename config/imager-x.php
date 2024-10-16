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
        // paths
        'imagerSystemPath' => '@assetBasePath/images/x',
        'imagerUrl' => '@assetBaseUrl/images/x',

        // image handling
        'jpegQuality' => 85,
        'allowUpscale' => false,
        'interlace' => 'plane',
        'removeMetadata' => true,
        'cacheDuration' => 60 * 60 * 24 * 365 * 10, // 10 years
        'removeTransformsOnAssetFileops' => true,

        // optimisers
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
        'filenamePattern' => '{fullname}.{extension}',
        'fallbackImage' => 'https://placehold.co/1800x1200.png',
        'customEncoders' => App::env('IMAGER_CWEBP_PATH')
            ? ArrayHelper::merge($defaultCustomEncoders, [
                'webp' => [
                    'path' => App::env('IMAGER_CWEBP_PATH'),
                ],
            ])
            : [],
    ],
];
