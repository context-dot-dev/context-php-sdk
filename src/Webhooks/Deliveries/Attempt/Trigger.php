<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Attempt;

/**
 * What started the attempt: `initial` is the first send, `automatic` is a scheduled retry, and `manual` came from `POST /webhooks/deliveries/{delivery_id}/retry`.
 */
enum Trigger: string
{
    case INITIAL = 'initial';

    case AUTOMATIC = 'automatic';

    case MANUAL = 'manual';
}
