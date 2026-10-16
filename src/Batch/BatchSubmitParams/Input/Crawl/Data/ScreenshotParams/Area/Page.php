<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ScreenshotParams\Area;

enum Page: string
{
    case VIEWPORT = 'viewport';

    case FULL_PAGE = 'fullPage';
}
