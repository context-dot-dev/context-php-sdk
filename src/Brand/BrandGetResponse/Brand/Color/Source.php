<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand\Color;

/**
 * `site` colors come from the website's own theme (rendered page colors, web app manifest, `theme-color` meta tag); `logo` colors come from logo pixels.
 */
enum Source: string
{
    case SITE = 'site';

    case LOGO = 'logo';
}
