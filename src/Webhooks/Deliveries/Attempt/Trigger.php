<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Attempt;

/**
 * What started this attempt.
 */
enum Trigger: string
{
    case INITIAL = 'initial';

    case AUTOMATIC = 'automatic';

    case MANUAL = 'manual';
}
