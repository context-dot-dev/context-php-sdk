<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse;

/**
 * Monitor category. Always `web`.
 */
enum Mode: string
{
    case WEB = 'web';
}
