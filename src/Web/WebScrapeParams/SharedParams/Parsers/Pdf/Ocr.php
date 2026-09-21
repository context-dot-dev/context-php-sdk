<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Parsers\Pdf;

/**
 * Read text from scanned pages.
 */
enum Ocr: string
{
    case OFF = 'off';

    case AUTO = 'auto';
}
