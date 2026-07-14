<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandRetrieveSimplifiedParams;

/**
 * Optional theme preference used when selecting brand assets.
 */
enum Theme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
