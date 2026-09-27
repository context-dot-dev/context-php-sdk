<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Parsers\Pdf;

/**
 * Set `auto` to read scanned pages with OCR.
 */
enum Ocr: string
{
    case OFF = 'off';

    case AUTO = 'auto';
}
