<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ScreenshotParams\Area;

enum Page: string
{
    case VIEWPORT = 'viewport';

    case FULL_PAGE = 'fullPage';
}
