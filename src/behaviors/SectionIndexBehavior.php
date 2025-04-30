<?php

namespace boilerplate\behaviors;

use Craft;
use craft\elements\Entry;
use yii\base\Behavior;

/**
 * Class SectionIndexBehavior
 *
 * Adds behavior to fetch a Section's index entry
 *
 * @property Section $owner
 */
class SectionIndexBehavior extends Behavior
{
    protected $indexEntry = false;

    // Returns the Section's corresponding Index entry
    public function getIndex_()
    {
        if ($this->indexEntry === false) {
            $this->indexEntry = Entry::find()
                ->index_($this->owner)
                ->cache()
                ->one();
        }

        return $this->indexEntry;
    }
}
