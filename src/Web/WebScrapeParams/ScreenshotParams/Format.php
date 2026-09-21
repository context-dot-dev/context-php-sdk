<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ScreenshotParams;

enum Format: string
{
    case PNG = 'png';

    case JPEG = 'jpeg';

    case WEBP = 'webp';
}
