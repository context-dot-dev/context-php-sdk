<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetSimplifiedResponse\Brand\Color;

/**
 * Where the color was observed: 'site' colors come from the website's own theme signals (rendered page colors, manifest, theme-color meta), 'logo' colors from logo image pixels.
 */
enum Source: string
{
    case SITE = 'site';

    case LOGO = 'logo';
}
