<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResponse;

/**
 * Current state. `completed`, `cancelled`, and `failed` are final.
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
