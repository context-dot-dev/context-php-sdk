<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

/**
 * Always `cancelling`. Pages in progress finish, then the batch becomes `cancelled`.
 */
enum Status: string
{
    case CANCELLING = 'cancelling';
}
