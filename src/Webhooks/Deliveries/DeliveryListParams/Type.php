<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliveryListParams;

/**
 * List monitor webhook deliveries.
 */
enum Type: string
{
    case MONITOR = 'monitor';
}
