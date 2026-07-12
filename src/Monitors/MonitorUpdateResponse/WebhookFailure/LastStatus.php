<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse\WebhookFailure;

/**
 * Outcome of the most recent failed delivery. rejected means a non-2xx response; failed means no HTTP response was received; skipped_unsafe_url means the URL failed the public-endpoint safety check.
 */
enum LastStatus: string
{
    case REJECTED = 'rejected';

    case FAILED = 'failed';

    case SKIPPED_UNSAFE_URL = 'skipped_unsafe_url';
}
