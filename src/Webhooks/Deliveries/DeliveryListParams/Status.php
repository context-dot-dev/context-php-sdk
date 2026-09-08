<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliveryListParams;

/**
 * Filter by delivery status.
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
