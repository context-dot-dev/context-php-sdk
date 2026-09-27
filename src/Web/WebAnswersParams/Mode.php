<?php

declare(strict_types=1);

namespace ContextDev\Web\WebAnswersParams;

/**
 * `fast` for short tasks; `ultra` for deeper research (default).
 */
enum Mode: string
{
    case FAST = 'fast';

    case ULTRA = 'ultra';
}
