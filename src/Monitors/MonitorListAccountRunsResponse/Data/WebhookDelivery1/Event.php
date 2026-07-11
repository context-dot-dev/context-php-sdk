<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountRunsResponse\Data\WebhookDelivery1;

/**
 * The event this delivery carried. Deliveries recorded before event selection existed report change.detected.
 */
enum Event: string
{
    case CHANGE_DETECTED = 'change.detected';

    case RUN_COMPLETED = 'run.completed';
}
