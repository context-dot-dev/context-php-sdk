<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\SharedParams;

/**
 * Emulate a light or dark color scheme.
 */
enum Theme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
