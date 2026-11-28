<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ImageParams;

/**
 * Set to `visual` to drop visually duplicate images, keeping the largest copy.
 */
enum Dedupe: string
{
    case NONE = 'none';

    case VISUAL = 'visual';
}
