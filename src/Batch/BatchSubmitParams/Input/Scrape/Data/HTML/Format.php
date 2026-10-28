<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML;

/**
 * Return page content as HTML.
 */
enum Format: string
{
    case HTML = 'html';
}
