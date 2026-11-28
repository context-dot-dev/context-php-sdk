<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Batch;

/**
 * The event came from a batch.
 */
enum Type: string
{
    case BATCH = 'batch';
}
