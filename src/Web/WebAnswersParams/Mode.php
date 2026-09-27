<?php

declare(strict_types=1);

namespace ContextDev\Web\WebAnswersParams;

/**
 * `fast` prioritizes speed, with extra verification for people and companies; `ultra` supports deeper research (default).
 */
enum Mode: string
{
    case FAST = 'fast';

    case ULTRA = 'ultra';
}
