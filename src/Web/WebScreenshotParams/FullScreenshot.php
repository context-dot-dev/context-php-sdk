<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

/**
 * Capture the full scrollable page instead of only the viewport.
 */
enum FullScreenshot: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
