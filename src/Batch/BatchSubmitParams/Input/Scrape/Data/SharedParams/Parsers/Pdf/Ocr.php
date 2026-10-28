<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams\Parsers\Pdf;

/**
 * Set `auto` to read scanned pages with OCR.
 */
enum Ocr: string
{
    case OFF = 'off';

    case AUTO = 'auto';
}
