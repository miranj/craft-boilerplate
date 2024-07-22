<?php
/**
 * Site URL Rules
 *
 * You can define custom site URL rules here, which Craft will check in addition
 * to routes defined in Settings → Routes.
 *
 * Read all about Craft’s routing behavior, here:
 * https://craftcms.com/docs/5.x/system/routing.html
 */

return [
    '_kitchen-sink' => ['template' => '_kitchen-sink'],

    '_views' => ['template' => '_all-views'],
    '_views/<viewType:{handle}>' => ['template' => '_all-views'],
    '_views/<viewType:{handle}>/<sectionHandle:{handle}>' => [
        'template' => '_all-views',
    ],
];
