<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountChangesResponse\Data;

/**
 * Monitor category. Always `web`.
 */
enum Mode: string
{
    case WEB = 'web';
}
