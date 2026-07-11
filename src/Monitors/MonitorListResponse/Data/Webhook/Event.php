<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data\Webhook;

enum Event: string
{
    case CHANGE_DETECTED = 'change.detected';

    case RUN_COMPLETED = 'run.completed';
}
