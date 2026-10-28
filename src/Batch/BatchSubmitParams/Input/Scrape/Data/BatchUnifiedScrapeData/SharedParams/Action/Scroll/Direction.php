<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\SharedParams\Action\Scroll;

/**
 * Direction to scroll.
 */
enum Direction: string
{
    case DOWN = 'down';

    case UP = 'up';

    case LEFT = 'left';

    case RIGHT = 'right';
}
