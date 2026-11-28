<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorRotateWebhookSecretResponse;

/**
 * `active` monitors run on schedule. `failed` monitors keep running after a failed run and return to `active` on the next success. `paused` monitors don't run until you set `status` to `active`; Context.dev also pauses monitors after repeated failures or credit shortfalls.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case PAUSED = 'paused';

    case FAILED = 'failed';
}
