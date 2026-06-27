<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

/**
 * Optional parameter to choose the site's visual theme in the screenshot. Use 'light' or 'dark' when the site offers both appearances.
 */
enum ColorScheme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
