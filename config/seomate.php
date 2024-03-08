<?php

// SEOMate plugin config
// https://github.com/vaersaagod/seomate

return [
    // Global config
    '*' => [
        // default meta
        'defaultMeta' => [
            'image' => ['seo.seoImageDefault'],
        ],
        'additionalMeta' => [
            'twitter:card' => 'summary_large_image',
            'og:site_name' => '{{ siteName }}',
            'og:type' => 'website',
            'og:see_also' => [],
        ],

        // entry meta cascades
        'defaultProfile' => 'standard',
        'fieldProfiles' => [
            'standard' => [
                'title' => ['seoTitle', 'title'],
                'description' => ['seoSummary', 'summary'],
                'image' => ['seoImage', 'image'],
            ],
        ],

        // hygiene
        'sitenameSeparator' => '-',
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
