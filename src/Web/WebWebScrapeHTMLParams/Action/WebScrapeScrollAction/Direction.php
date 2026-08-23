<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLParams\Action\WebScrapeScrollAction;

/**
 * Direction to scroll. Defaults to down.
 */
enum Direction: string
{
    case UP = 'up';

    case DOWN = 'down';

    case LEFT = 'left';

    case RIGHT = 'right';
}
