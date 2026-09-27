<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

/**
 * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
 */
enum Zdr: string
{
    case ENABLED = 'enabled';

    case DISABLED = 'disabled';
}
