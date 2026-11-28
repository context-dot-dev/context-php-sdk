<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand\Logo;

/**
 * `light` works best in light mode, `dark` works best in dark mode, and `has_opaque_background` works in either because the image has its own background.
 */
enum Mode: string
{
    case LIGHT = 'light';

    case DARK = 'dark';

    case HAS_OPAQUE_BACKGROUND = 'has_opaque_background';
}
