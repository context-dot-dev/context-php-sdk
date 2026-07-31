<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdResponse\ActionsApplied;

/**
 * Applied means the requested page state was visibly verified. Failed means it was not verified. Skipped means it was not attempted.
 */
enum Status: string
{
    case APPLIED = 'applied';

    case FAILED = 'failed';

    case SKIPPED = 'skipped';
}
