<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown;

/**
 * Return page content as Markdown.
 */
enum Format: string
{
    case MARKDOWN = 'markdown';
}
