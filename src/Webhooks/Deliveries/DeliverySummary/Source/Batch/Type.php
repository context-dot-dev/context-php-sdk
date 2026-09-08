<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Batch;

/**
 * Delivery source.
 */
enum Type: string
{
    case BATCH = 'batch';
}
