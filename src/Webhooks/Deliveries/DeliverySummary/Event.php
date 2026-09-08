<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary;

/**
 * Webhook event type.
 */
enum Event: string
{
    case BATCH_COMPLETED = 'batch.completed';

    case BATCH_FAILED = 'batch.failed';

    case BATCH_CANCELLED = 'batch.cancelled';

    case CHANGE_DETECTED = 'change.detected';

    case RUN_COMPLETED = 'run.completed';
}
