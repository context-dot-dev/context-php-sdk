<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

/**
 * Always `queued`. An accepted batch has not started yet.
 */
enum Status: string
{
    case QUEUED = 'queued';
}
