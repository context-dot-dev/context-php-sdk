<?php

declare(strict_types=1);

namespace ContextDev\Monitors\WebhookDelivery;

/**
 * Outcome of the delivery attempt. Any 2xx response counts as delivered.
 */
enum Status: string
{
    case DELIVERED = 'delivered';

    case REJECTED = 'rejected';

    case FAILED = 'failed';

    case SKIPPED_UNSAFE_URL = 'skipped_unsafe_url';
}
