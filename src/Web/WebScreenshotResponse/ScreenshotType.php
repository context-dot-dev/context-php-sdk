<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotResponse;

/**
 * Whether the image covers the viewport or the full page.
 */
enum ScreenshotType: string
{
    case VIEWPORT = 'viewport';

    case FULL_PAGE = 'fullPage';
}
