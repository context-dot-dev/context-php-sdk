<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll;

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
