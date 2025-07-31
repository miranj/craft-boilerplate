<?php

namespace boilerplate;

use Craft;
use craft\elements\Entry;
use boilerplate\behaviors\EntryIndexQueryBehavior;
use boilerplate\behaviors\IndexEntryBehaviors;
use boilerplate\behaviors\SectionIndexBehavior;
use boilerplate\twig\Extension;
use craft\models\Section;
use craft\base\Element;
use craft\elements\db\EntryQuery;
use craft\events\DefineBehaviorsEvent;
use craft\web\Response;
use yii\base\Event;
use craft\validators\DateCompareValidator;

/**
 * Custom module class.
 *
 * This class will be available throughout the system via:
 * `Craft::$app->getModule('my-module')`.
 *
 * You can change its module ID ("my-module") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, uncomment this line
 * in config/app.php:
 *
 *     'bootstrap' => ['my-module']
 *
 * Learn more about Yii module development in Yii's documentation:
 * http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 */
class Module extends \yii\base\Module
{
    /**
     * Initializes the module.
     */
    public function init()
    {
        // Set a @modules alias pointed to the modules/ directory
        Craft::setAlias('@boilerplate', __DIR__);
        parent::init();

        $this->addEventListeners();

        // Register Twig extensions
        if (Craft::$app->getRequest()->getIsSiteRequest()) {
            $view = Craft::$app->getView();
            $view->registerTwigExtension(new Extension($view));
        }
    }

    /**
     * [P|A]jax redirect header override handler
     */
    public function onBeforeSendPjaxRedirect(Event $event)
    {
        $response = $event->sender;
        $headers = $response->getHeaders();

        // If the response is a redirect, and
        // if it is a redirect with [P|A]jax but not Location, then set the Location header
        if (
            $response->getIsRedirection() &&
            !$headers->has('Location') &&
            ($headers->has('X-Pjax-Url') || $headers->has('X-Redirect'))
        ) {
            $headers->set(
                'Location',
                $headers->get('X-Pjax-Url', $headers->get('X-Redirect')),
            );
        }
    }

    /**
     * Allow cross-domain live preview requests by setting frame-ancestors to CP URL
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/frame-ancestors
     */
    public function onBeforeSendLivePreview(Event $event)
    {
        $request = Craft::$app->request;
        if ($request->isLivePreview || $request->isPreview) {
            $parsedBaseCpUrl = parse_url(
                Craft::$app->config->general->baseCpUrl,
            );
            $headers = $event->sender->getHeaders();
            $headers->set(
                'Content-Security-Policy',
                'frame-ancestors ' .
                    implode(
                        ':',
                        array_filter([
                            $parsedBaseCpUrl['host'] ?? '',
                            $parsedBaseCpUrl['port'] ?? '',
                        ]),
                    ),
            );
            $headers->set('X-Accel-Expires', '0');
        }
    }

    /**
     * Custom validation rule to ensure Event end date should be greater than start date
     * https://craftcms.com/docs/3.x/extend/extending-system-components.html#custom-validation-rules
     */
    public function validateEventEndDateTime(Event $event)
    {
        // Elements to be validated
        $validateElementTypes = [
            Entry::class => [
                // Section:EntryType
                'events:event',
            ],
        ];

        // Set Entry data
        $element = $event->sender;

        // Only check elements in the include-list
        $context =
            ($element->section->handle ?? '*') . ':' . $element->type->handle;
        if (!in_array($context, $validateElementTypes[get_class($element)])) {
            return;
        }

        // Disallow only end date but no start date
        $event->rules[] = [
            'field:endDateTime',
            'required',
            'when' => function ($model) {
                return !empty($model->endDateTime);
            },
            'on' => Entry::SCENARIO_LIVE,
        ];

        // Both start and end dates should be present
        if (!empty($element->endDateTime) && !empty($element->startDateTime)) {
            $event->rules[] = [
                ['field:endDateTime'],
                DateCompareValidator::class,
                'operator' => '>=',
                'compareAttribute' => 'field:startDateTime',
                'on' => Entry::SCENARIO_LIVE,
            ];
        }
    }

    // define entry behaviors
    // - custom index entry properties
    public function onEntryDefineBehaviors(DefineBehaviorsEvent $event)
    {
        $entry = $event->sender;
        if (
            $entry->id &&
            $entry->sectionId &&
            strpos(
                $entry->section->handle,
                IndexEntryBehaviors::$sectionHandlePrefix,
            ) === 0
        ) {
            $event->behaviors[IndexEntryBehaviors::class] =
                IndexEntryBehaviors::class;
        }
    }

    // define custom index query
    public function onEntryQueryDefineBehaviors(DefineBehaviorsEvent $event)
    {
        $event->behaviors[EntryIndexQueryBehavior::class] =
            EntryIndexQueryBehavior::class;
    }

    // define custom Section properties
    public function onSectionDefineBehaviors(DefineBehaviorsEvent $event)
    {
        if ($event->sender instanceof Section && $event->sender->id) {
            $event->behaviors[SectionIndexBehavior::class] =
                SectionIndexBehavior::class;
        }
    }

    // Protected Methods
    // =================

    protected function addEventListeners()
    {
        Event::on(Response::class, Response::EVENT_BEFORE_SEND, [
            $this,
            'onBeforeSendPjaxRedirect',
        ]);

        Event::on(Response::class, Response::EVENT_BEFORE_SEND, [
            $this,
            'onBeforeSendLivePreview',
        ]);

        // Event::on(Entry::class, Entry::EVENT_DEFINE_RULES, [
        //     $this,
        //     'validateEventEndDateTime',
        // ]);

        Event::on(Entry::class, Element::EVENT_DEFINE_BEHAVIORS, [
            $this,
            'onEntryDefineBehaviors',
        ]);

        Event::on(EntryQuery::class, EntryQuery::EVENT_DEFINE_BEHAVIORS, [
            $this,
            'onEntryQueryDefineBehaviors',
        ]);

        Event::on(Section::class, Section::EVENT_DEFINE_BEHAVIORS, [
            $this,
            'onSectionDefineBehaviors',
        ]);
    }
}
