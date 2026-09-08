<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliveryListParams;

/**
 * Delivery source.
 */
enum Type: string
{
    case MONITOR = 'monitor';
}
