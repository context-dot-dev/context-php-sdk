<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ImageParams;

/**
 * For visual duplicates, keep the largest image.
 */
enum Dedupe: string
{
    case NONE = 'none';

    case VISUAL = 'visual';
}
