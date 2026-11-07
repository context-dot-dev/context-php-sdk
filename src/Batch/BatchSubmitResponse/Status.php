<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

/**
 * Current state. `pending` means waiting for execution capacity or background validation. Capacity-limited batches remain pending until a slot opens. `completed`, `cancelled`, and `failed` are final.
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
