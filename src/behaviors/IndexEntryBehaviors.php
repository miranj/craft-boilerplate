<?php

namespace boilerplate\behaviors;

use Craft;
use craft\models\Section;
use yii\base\Behavior;

/**
 * Class IndexEntryBehaviors
 *
 * Adds certain behaviors to all Index Single entries
 *
 * @property Entry $owner
 */
class IndexEntryBehaviors extends Behavior
{
    // Sections which the behavior should be attached to
    public static $sectionHandlePrefix = 'index_';

    // Fetch the section for which this entry serves as the index
    public function getIndexSection_(): Section|null
    {
        $indexSection = $this->owner->getSection()->handle;
        $indexSection = preg_replace(
            '/^' . $this::$sectionHandlePrefix . '/',
            '',
            $indexSection,
            1,
        );
        $indexSection = Craft::$app->sections->getSectionByHandle(
            $indexSection,
        );
        return $indexSection;
    }
}
