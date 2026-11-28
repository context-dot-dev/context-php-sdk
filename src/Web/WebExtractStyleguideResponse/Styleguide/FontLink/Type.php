<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink;

/**
 * `google` for Google Fonts, `custom` for any other font source.
 */
enum Type: string
{
    case GOOGLE = 'google';

    case CUSTOM = 'custom';
}
