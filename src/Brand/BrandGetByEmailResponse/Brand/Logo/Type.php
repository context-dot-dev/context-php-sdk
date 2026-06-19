<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByEmailResponse\Brand\Logo;

/**
 * Type of the logo based on resolution (e.g., 'icon', 'logo').
 */
enum Type: string
{
    case ICON = 'icon';

    case LOGO = 'logo';
}
