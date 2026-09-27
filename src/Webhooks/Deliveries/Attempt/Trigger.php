<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Attempt;

/**
 * `initial`, `automatic` (scheduled retry), or `manual` (Retry endpoint).
 */
enum Trigger: string
{
    case INITIAL = 'initial';

    case AUTOMATIC = 'automatic';

    case MANUAL = 'manual';
}
