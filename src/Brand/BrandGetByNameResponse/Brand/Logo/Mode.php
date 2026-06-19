<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByNameResponse\Brand\Logo;

/**
 * Indicates when this logo is best used: 'light' = best for light mode, 'dark' = best for dark mode, 'has_opaque_background' = can be used for either as image has its own background.
 */
enum Mode: string
{
    case LIGHT = 'light';

    case DARK = 'dark';

    case HAS_OPAQUE_BACKGROUND = 'has_opaque_background';
}
