<?php

/**
 * Configuration file for Queue Monitor
 * https://verbb.io/craft-plugins/queue-monitor/docs/get-started/configuration
 *
 * Stalled queue checks need a cron job (see README).
 * eg: *\/5 * * * * /path/to/project/craft queue-monitor/stalled/check
 */

use craft\helpers\App;

$notificationEmails = array_filter([App::env('QUEUE_MONITOR_EMAIL')]);

return [
    '*' => [
        // Failed jobs
        'restartFailedJobs' => true,
        'restartMaxTries' => 3,
        'restartInterval' => 10,
        'sendFailedJobEmail' => !empty($notificationEmails),
        'failedJobEmails' => $notificationEmails,

        // Stalled queue
        'monitorStalledQueue' => true,
        'stalledQueueThreshold' => 30,
        'stalledQueueCheckInterval' => 60,
        'sendStalledQueueEmail' => !empty($notificationEmails),
        'stalledQueueEmails' => $notificationEmails,
    ],

    'dev' => [
        'restartFailedJobs' => false,
        'monitorStalledQueue' => false,
    ],
];
