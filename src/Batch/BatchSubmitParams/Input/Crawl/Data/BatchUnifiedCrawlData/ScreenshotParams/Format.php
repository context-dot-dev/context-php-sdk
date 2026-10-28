<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\BatchUnifiedCrawlData\ScreenshotParams;

/**
 * Image format for the screenshot.
 */
enum Format: string
{
    case PNG = 'png';

    case JPEG = 'jpeg';

    case WEBP = 'webp';
}
