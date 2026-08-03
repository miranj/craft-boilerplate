<?php

namespace boilerplate\filters;

use craft\elements\Entry;
use craft\elements\GlobalSet;

/**
 * Class EntryTypeFilter
 *
 * ⚠️ Only works on Matrix fields set to View Mode as `Blocks`.
 * `Cards`, `Card grid`, and `Index` views bypass `EVENT_DEFINE_ENTRY_TYPES`
 * while building their `Add New` menu items.
 *
 * This exists for legacy projects that previously relied on MatrixMate for
 * per-context block restrictions. New projects don't need it - these
 * [changes](https://github.com/miranj/craft-boilerplate/pull/154/changes) should be deleted.
 */
class EntryTypeFilter
{
    /**
     * Provides hidden blocks for matrix field context
     *
     *intended output:
     * Array (hidden blocks)
     * ```
     *     [
     *         'fieldHandle' => [
     *             'sectionHandle' => [
     *                 'blockHandle1',
     *                 'blockHandle2',
     *             ],
     *             'globalSetHandle' => [
     *                 'blockHandle1',
     *                 'blockHandle2',
     *             ],
     *         ],
     *     ]
     * ```
     */
    public static function getHiddenBlocksConfig(): array
    {
        return [];
    }

    /**
     * Determines whether blocks should be filtered
     *
     * input:
     * Field handle
     * Section or Globalset handle
     * Entry or Globalset event element
     *
     *intended output:
     * Boolean (true or false)
     */
    public static function shouldFilterBlocks(
        string $fieldHandle = '',
        string $elementHandle = '',
        $element = null,
    ): bool {
        if (!$fieldHandle || !$elementHandle || !$element) {
            return false;
        }

        if (!($element instanceof Entry or $element instanceof GlobalSet)) {
            return false;
        }

        $builderHiddenBlocks = self::getHiddenBlocksConfig();

        return isset($builderHiddenBlocks[$fieldHandle][$elementHandle]);
    }

    /**
     * Returns allowed blocks for a matrix field based on context
     *
     * input:
     * Array of block handles
     * Section or Globalset handle
     * Field handle
     *
     *intended output:
     * Array (of allowed block handles)
     */
    public static function getAllowedBlocks(
        array $allBlocks = [],
        string $section = '',
        string $field = '',
    ): array {
        $hiddenBlocks = self::getHiddenBlocksConfig()[$field][$section] ?? [];
        return array_diff($allBlocks, $hiddenBlocks);
    }
}
