<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary;

/**
 * Delivery state. `pending` is waiting for an attempt, `delivering` has an attempt in progress, `retrying` is waiting for an automatic retry, `delivered` was acknowledged with a 2xx, `failed` has no automatic retries left, and `cancelled` means the source or its webhook was removed.
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
