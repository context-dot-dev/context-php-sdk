<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorRotateWebhookSecretResponse\WebhookFailure;

/**
 * Outcome of the most recent failed delivery: `rejected` (non-2xx response), `failed` (no response), or `skipped_unsafe_url` (the URL isn't a safe public endpoint).
 */
enum LastStatus: string
{
    case REJECTED = 'rejected';

    case FAILED = 'failed';

    case SKIPPED_UNSAFE_URL = 'skipped_unsafe_url';
}
