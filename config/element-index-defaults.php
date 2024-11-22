<?php

/**
 * Configuration settings for Element Index Defaults plugin
 * https://github.com/verbb/element-index-defaults
 *
 */

use craft\elements\Asset;
use craft\elements\Category;
use craft\elements\Entry;

return [
    'elementDefaults' => [
        Entry::class => ['postDate', 'link', 'dateUpdated', 'revisionCreator'],
        Category::class => ['_childme_addChild', 'slug', 'dateUpdated'],
        Asset::class => ['filename', 'size', 'dateModified', 'link'],
    ],
];
