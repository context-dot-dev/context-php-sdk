<?php

declare(strict_types=1);

namespace ContextDev\Web\WebAnswersParams;

/**
 * `fast` prioritizes speed and adds extra verification for people and companies; `ultra` searches and reads more sources for deeper research. Defaults to `ultra`.
 */
enum Mode: string
{
    case FAST = 'fast';

    case ULTRA = 'ultra';
}
