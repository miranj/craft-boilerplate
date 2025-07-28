<?php

// Feed Me config
// https://docs.craftcms.com/feed-me/v6/get-started/configuration.html

use craft\helpers\App;

return [
    '*' => [
        'assetDownloadGuzzle' => true,
        'clientOptions' =>
            App::env('FEEDME_AUTH_USER') && App::env('FEEDME_AUTH_PASSWORD')
                ? [
                    'auth' => [
                        App::env('FEEDME_AUTH_USER'),
                        App::env('FEEDME_AUTH_PASSWORD'),
                    ],
                ]
                : [],
    ],
];
