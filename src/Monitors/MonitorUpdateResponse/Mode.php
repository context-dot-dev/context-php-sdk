<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorUpdateResponse;

/**
 * Top-level monitor category. Always `web` today; the concrete behavior is described by `target` and `change_detection`.
 */
enum Mode: string
{
    case WEB = 'web';
}
