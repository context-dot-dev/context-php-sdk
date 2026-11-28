<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand\Logo;

/**
 * Whether the image is an `icon` or a full `logo`, based on its dimensions.
 */
enum Type: string
{
    case ICON = 'icon';

    case LOGO = 'logo';
}
