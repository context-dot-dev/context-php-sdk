<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

/**
 * Override the browser color scheme.
 */
enum Theme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
