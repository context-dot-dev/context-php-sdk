<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

/**
 * Monitor category. Always `web`.
 */
enum Mode: string
{
    case WEB = 'web';
}
