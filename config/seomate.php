<?php

// SEOMate plugin config
// https://github.com/vaersaagod/seomate

return [
    // Global config
    '*' => [
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
                'title' => ['seoTitle', 'title'],
                'description' => ['seoSummary', 'summary'],
                'image' => ['seoImage', 'image'],
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
            'elements' => [
                'homepage' => ['changefreq' => 'weekly', 'priority' => 1.0],
                'indexes' => [
                    'elementType' => \craft\elements\Entry::class,
                    'criteria' => [
                        'section' => [],
                    ],
                    'params' => ['changefreq' => 'weekly', 'priority' => 0.1],
                ],
            ],
        ],
    ],

    // Dev environment
    'dev' => [
        'cacheEnabled' => false,
    ],
];
