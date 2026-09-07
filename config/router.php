<?php
/**
 * Router URL Rules
 * https://github.com/miranj/craft-router
 */

// Common URL patterns
define('URL_PATTERN_YEAR', '(?:19|20)\d{2}'); // 1900-2099
define('URL_PATTERN_MONTH', '(?:0?[1-9]|1[012])'); // 01-12
define(
    'URL_PATTERN_YYYYMM',
    URL_PATTERN_YEAR . '(?:/' . URL_PATTERN_MONTH . ')?',
);

/**
 * Helper class to generate router configs
 */
class RouterConfig
{
    public static $config = [
        // key => [ <url segment pattern> , <criteria definition> ]

        'academicLevel' => [
            'level:<academicLevel:{slug}>',
            'entry:academicLevels',
        ],
        'department' => ['department:<department:{slug}>', 'entry:departments'],
        'eventType' => ['type:<eventType:{slug}>', 'category:eventTypes'],
        'newsType' => ['type:<newsType:{slug}>', 'category:newsTypes'],
        'office' => ['office:<office:{slug}>', 'entry:offices'],
        'opportunityType' => [
            'type:<opportunityType:{slug}>',
            'category:opportunityTypes',
        ],
        'orgPersonRole' => [
            'role:<orgPersonRole:{slug}>',
            [
                'type' => 'field',
                'handle' => 'orgPersonRoles',
                'alias' => 'roles',
            ],
        ],
        'projectType' => ['type:<projectType:{slug}>', 'category:projectTypes'],
        'resourceType' => [
            'type:<resourceType:{slug}>',
            'category:resourcesTypes',
        ],
        'topic' => ['topic:<topic:{slug}>', 'category:topics'],

        'year' => ['<year:' . URL_PATTERN_YEAR . '>', 'date'],
        'yearStartDate' => [
            '<yearStartDate:' . URL_PATTERN_YEAR . '>',
            'date:startDateTime',
        ],
        'yearMonthStartDate' => [
            '<yearMonthStartDate:' . URL_PATTERN_YYYYMM . '>',
            'date:startDateTime',
        ],
    ];

    public static $defaultTemplate = '_routers/index';
    public static $defaultCriteria = ['section' => 'section'];

    public static function define(
        array $filters,
        $extraCriteria = null,
        $template = '',
        $combineSegments = true,
    ) {
        // pluck segments
        $segments = array_map(function ($value) {
            return self::$config[$value][0];
        }, $filters);

        // pluck criteria, merge with extra
        $criteria = array_map(function ($value) {
            return self::$config[$value][1];
        }, $filters);
        $criteria = array_combine($filters, $criteria);
        $criteria = array_merge(
            $criteria,
            $extraCriteria === null ? self::$defaultCriteria : $extraCriteria,
        );

        return [
            'segments' => $segments,
            'combineSegments' => $combineSegments,
            'criteria' => $criteria,
            'template' => $template ?: self::$defaultTemplate,
        ];
    }
}

return [
    'rules' => [
        '<section:blog>' => RouterConfig::define(['year']),

        '<section:events>' => RouterConfig::define([
            'yearMonthStartDate',
            'eventType',
            'department',
        ]),

        '<section:jobs>' => RouterConfig::define([
            'opportunityType',
            'department',
            'office',
        ]),

        '<section:news>' => RouterConfig::define([
            'year',
            'newsType',
            'department',
        ]),

        '<section:people>' => RouterConfig::define([
            'orgPersonRole',
            'department',
            'office',
        ]),

        '<section:programmes>' => RouterConfig::define([
            'academicLevel',
            'department',
        ]),

        '<section:projects>' => RouterConfig::define([
            'projectType',
            'department',
            'topic',
        ]),

        '<section:publications>' => RouterConfig::define(['department']),

        '<section:resources>' => RouterConfig::define([
            'resourceType',
            'department',
            'office',
        ]),
    ],
];
