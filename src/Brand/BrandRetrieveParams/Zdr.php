<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandRetrieveParams;

/**
 * `enabled` turns off request logs and traces and keeps request and response content out of usage logs. Brand data and hosted assets may still be stored. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
 */
enum Zdr: string
{
    case ENABLED = 'enabled';

    case DISABLED = 'disabled';
}
