<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Parsers\Pdf;

/**
 * Set to `auto` to read scanned pages with OCR. Adds 1 credit per page read.
 */
enum Ocr: string
{
    case OFF = 'off';

    case AUTO = 'auto';
}
