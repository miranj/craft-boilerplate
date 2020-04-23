<?php

namespace boilerplate;

use Craft;
use craft\web\Response;
use yii\base\Event;

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
    }
    
    /**
     * [P|A]jax redirect header override handler
     */
    public function onBeforeSend(Event $event)
    {
        $response = $event->sender;
        $headers = $response->getHeaders();
        
        // If the response is a redirect, and
        // if it is a redirect with [P|A]jax but not Location, then set the Location header
        if ($response->getIsRedirection()
        && !$headers->has('Location')
        && ($headers->has('X-Pjax-Url') || $headers->has('X-Redirect'))) {
            $headers->set('Location', $headers->get('X-Pjax-Url', $headers->get('X-Redirect')));
        }
    }
    
    
    
    // Protected Methods
    // =================
    
    protected function addEventListeners()
    {
        Event::on(
            Response::class,
            Response::EVENT_BEFORE_SEND,
            [$this, 'onBeforeSend']
        );
    }
}
