<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

/**
 * Whether the site's design is mainly light or dark.
 */
enum Mode: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
