<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotResponse;

/**
 * Type of screenshot that was captured.
 */
enum ScreenshotType: string
{
    case VIEWPORT = 'viewport';

    case FULL_PAGE = 'fullPage';
}
