<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

/**
 * Current state. `pending` batches are being validated or are waiting for a slot under your plan's concurrent batch limit, `queued` batches are ready to start, and `running` batches are scraping. `completed`, `cancelled`, and `failed` are final.
 */
enum Status: string
{
    case PENDING = 'pending';

    case QUEUED = 'queued';

    case RUNNING = 'running';

    case CANCELLING = 'cancelling';

    case COMPLETED = 'completed';

    case CANCELLED = 'cancelled';

    case FAILED = 'failed';
}
