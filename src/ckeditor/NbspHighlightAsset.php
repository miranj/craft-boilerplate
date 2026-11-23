<?php

namespace boilerplate\ckeditor;

use craft\ckeditor\web\assets\BaseCkeditorPackageAsset;

/**
 * CKEditor package that highlights non-breaking spaces in every CKEditor field.
 *
 * It has no toolbar items, so the CKEditor plugin loads it for all fields.
 */
class NbspHighlightAsset extends BaseCkeditorPackageAsset
{
    public $sourcePath = __DIR__ . '/nbsp-highlight';

    public $css = ['nbsp-highlight.css'];

    public string $namespace = '@boilerplate/ckeditor-nbsp-highlight';

    public array $pluginNames = ['NbspHighlight'];
}
