<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Delivery\Source\Batch;

/**
 * The event came from a batch.
 */
enum Type: string
{
    case BATCH = 'batch';
}
