<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Delivery\Source\Monitor;

/**
 * The event came from a monitor run.
 */
enum Type: string
{
    case MONITOR = 'monitor';
}
