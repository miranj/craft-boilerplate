<?php

namespace boilerplate\behaviors;

use Craft;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use craft\models\Section;
use yii\base\Behavior;

/**
 * Class EntryIndexQueryBehavior
 *
 * Adds the ability to query for an entry's Index (single) entry
 *
 * @property Entry $owner
 */
class EntryIndexQueryBehavior extends Behavior
{
    // query for the Index entry of the passed in value
    public function index_($value): EntryQuery
    {
        $sectionHandle = '';

        if ($value instanceof Entry) {
            $sectionHandle = $value->getSection()->handle;
        } elseif ($value instanceof Section) {
            $sectionHandle = $value->handle;
        } elseif (is_string($value)) {
            $sectionHandle = $value;
        }

        if ($sectionHandle !== '') {
            $this->owner->section('index_' . $sectionHandle)->limit(1);
        }

        return $this->owner;
    }
}
