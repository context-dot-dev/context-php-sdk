<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListParams;

/**
 * Filter by status.
 */
enum Status: string
{
    case QUEUED = 'queued';

    case RUNNING = 'running';

    case CANCELLING = 'cancelling';

    case COMPLETED = 'completed';

    case CANCELLED = 'cancelled';

    case FAILED = 'failed';
}
