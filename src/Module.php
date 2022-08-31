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
            $headers = $event->sender->getHeaders();
            $headers->set(
                'Content-Security-Policy',
                'frame-ancestors ' .
                    parse_url(
                        Craft::$app->config->general->baseCpUrl,
                        PHP_URL_HOST,
                    ),
            );
            $headers->set('X-Accel-Expires', '0');
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
    }
}
