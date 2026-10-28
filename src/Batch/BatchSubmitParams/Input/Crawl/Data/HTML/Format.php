<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML;

/**
 * Return page content as HTML.
 */
enum Format: string
{
    case HTML = 'html';
}
