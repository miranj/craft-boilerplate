<?php

// SEOMate plugin config
// https://github.com/vaersaagod/seomate

use craft\helpers\ArrayHelper;
use vaersaagod\seomate\models\Settings as SEOMateSettings;

$defaultSettings = new SEOMateSettings();

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
        'metaPropertyTypes' => ArrayHelper::merge(
            $defaultSettings->metaPropertyTypes,
            [
                'title,og:title,twitter:title' => [
                    'maxLength' => 100,
                ],
            ],
            true,
        ),
        'tagTemplateMap' => ArrayHelper::merge(
            $defaultSettings->tagTemplateMap,
            [
                'links' => "{{ tag('link', value) }}",
            ],
        ),

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
