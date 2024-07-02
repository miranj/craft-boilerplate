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
        Entry::class => ['title', 'dateUpdated', 'revisionCreator', 'link'],
        Category::class => ['title', 'dateCreated', 'dateUpdated'],
        Asset::class => ['title', 'filename', 'size', 'dateModified', 'link'],
    ],
];
