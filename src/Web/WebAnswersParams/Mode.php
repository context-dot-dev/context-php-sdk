<?php

declare(strict_types=1);

namespace ContextDev\Web\WebAnswersParams;

/**
 * Research level: fast uses a smaller model and research budget for 10 credits; ultra uses deeper reasoning and research for 100 credits. Defaults to ultra. Only successful requests consume credits.
 */
enum Mode: string
{
    case FAST = 'fast';

    case ULTRA = 'ultra';
}
