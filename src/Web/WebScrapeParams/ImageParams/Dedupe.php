<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ImageParams;

/**
 * Set `visual` to drop visual duplicates, keeping the largest copy.
 */
enum Dedupe: string
{
    case NONE = 'none';

    case VISUAL = 'visual';
}
