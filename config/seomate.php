<?php

// SEOMate plugin config
// https://github.com/vaersaagod/seomate

return [
    // Global config
    '*' => [
        'previewEnabled' => false,
        'sitenameSeparator' => '-',

        'additionalMeta' => [
            'twitter:card' => 'summary_large_image',
            'og:site_name' => '{{ siteName }}',
            'og:type' => 'website',
            'og:see_also' => [],
        ],

        'defaultProfile' => 'standard',
        'fieldProfiles' => [
            'standard' => [
                'title' => ['title'],
            ],
        ],

        'applyRestrictions' => true,
        'metaPropertyTypes' => [
            'title,og:title,twitter:title' => [
                'type' => 'text',
                'minLength' => 10,
                'maxLength' => 100,
            ],
            'description,og:description,twitter:description' => [
                'type' => 'text',
                'minLength' => 50,
                'maxLength' => 300,
            ],
            'image,og:image,twitter:image' => [
                'type' => 'image',
            ],
        ],

        'sitemapEnabled' => true,
        'sitemapLimit' => 100,
        'sitemapConfig' => [
            'elements' => [],
        ],
    ],

    // Dev environment
    'dev' => [
        'cacheEnabled' => false,
        'previewEnabled' => true,
    ],
];
