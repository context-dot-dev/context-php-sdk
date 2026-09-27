<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Monitor;

/**
 * Which deliveries to list: `batch` or `monitor`.
 */
enum Type: string
{
    case MONITOR = 'monitor';
}
