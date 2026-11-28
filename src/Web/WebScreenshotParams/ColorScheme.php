<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

/**
 * Emulate a light or dark color scheme.
 */
enum ColorScheme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
