<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideParams;

/**
 * `enabled` disables request logs, usage logs, and traces. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
 */
enum Zdr: string
{
    case ENABLED = 'enabled';

    case DISABLED = 'disabled';
}
