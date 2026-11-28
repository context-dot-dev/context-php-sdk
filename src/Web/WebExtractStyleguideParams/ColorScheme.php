<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideParams;

/**
 * Emulate a light or dark color scheme. Each scheme is cached separately.
 */
enum ColorScheme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
