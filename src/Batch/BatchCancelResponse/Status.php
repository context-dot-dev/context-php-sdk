<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

/**
 * Always `cancelling`. Work already in flight finishes; the batch reaches `cancelled` shortly after.
 */
enum Status: string
{
    case CANCELLING = 'cancelling';
}
