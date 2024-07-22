<?php

/**
 * Configuration file for Imager Named Transforms
 * https://imager-x.spacecat.ninja/usage/named-transforms.html
 *
 * eg:
 *      // auto-fills intermediate transforms between 200w-800w, and
 *      // crops the image to 16/9 ratio. (see docs for full syntax)
 *      // https://imager-x.spacecat.ninja/usage/#quick-syntax
 *
 *      'thumbnail' => [
 *          'transforms' => [200, 800, 16/9],
 *      ],
 */

return [
    'content' => [
        'transforms' => [400, 1800],
    ],

    'logo' => [
        'transforms' => [120, 600],
    ],
];
