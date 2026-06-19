<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

/**
 * The primary color mode of the website design.
 */
enum Mode: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
