<?php

declare(strict_types=1);

namespace ContextDev\Monitors\WebhookDelivery;

/**
 * Outcome of the delivery: `delivered` (2xx response), `rejected` (non-2xx response), `failed` (no response), or `skipped_unsafe_url` (the URL isn't a safe public endpoint).
 */
enum Status: string
{
    case DELIVERED = 'delivered';

    case REJECTED = 'rejected';

    case FAILED = 'failed';

    case SKIPPED_UNSAFE_URL = 'skipped_unsafe_url';
}
