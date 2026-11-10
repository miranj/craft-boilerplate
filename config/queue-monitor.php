<?php

/**
 * Configuration file for Queue Monitor
 * https://verbb.io/craft-plugins/queue-monitor/docs/get-started/configuration
 *
 * Stalled queue checks need a cron job (see README).
 * eg: *\/5 * * * * /path/to/project/craft queue-monitor/stalled/check
 */

return [
    '*' => [
        // Failed jobs
        'restartFailedJobs' => true,
        'restartMaxTries' => 3,
        'restartInterval' => 10,
        'sendFailedJobEmail' => true,
        'failedJobEmails' => [],

        // Stalled queue
        'monitorStalledQueue' => true,
        'stalledQueueThreshold' => 30,
        'stalledQueueCheckInterval' => 60,
        'sendStalledQueueEmail' => true,
        'stalledQueueEmails' => [],
    ],

    'dev' => [
        'restartFailedJobs' => false,
        'sendFailedJobEmail' => false,
        'monitorStalledQueue' => false,
        'sendStalledQueueEmail' => false,
    ],

    'staging' => [
        // TODO: Add email addresses for staging alerts
        'failedJobEmails' => [],
        'stalledQueueEmails' => [],
    ],

    'production' => [
        // TODO: Add email addresses for production alerts
        'failedJobEmails' => [],
        'stalledQueueEmails' => [],
    ],
];
