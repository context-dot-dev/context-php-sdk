<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideParams;

/**
 * Optional browser color scheme to emulate for websites that respond to prefers-color-scheme. This value is part of the styleguide cache key.
 */
enum ColorScheme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
