<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary;

/**
 * `pending`, `delivering`, `retrying`, `delivered`, `failed`, or `cancelled` (source or its webhook was removed).
 */
enum Status: string
{
    case PENDING = 'pending';

    case DELIVERING = 'delivering';

    case RETRYING = 'retrying';

    case DELIVERED = 'delivered';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
