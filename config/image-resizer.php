<?php

/**
 * Configuration file for Image Resizer
 * https://verbb.io/craft-plugins/image-resizer/docs/v3/get-started/configuration
 */

return [
    '*' => [
        'enabled' => true,
        'imageWidth' => 3600,
        'imageHeight' => 3600,
        'imageQuality' => 100,
        'skipLarger' => true,
        'nonDestructiveResize' => false,
    ],
];
