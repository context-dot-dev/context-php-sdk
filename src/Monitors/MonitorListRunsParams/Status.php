<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListRunsParams;

enum Status: string
{
    case QUEUED = 'queued';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
