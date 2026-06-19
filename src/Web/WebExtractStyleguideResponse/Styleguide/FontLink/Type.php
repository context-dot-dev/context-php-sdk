<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractStyleguideResponse\Styleguide\FontLink;

enum Type: string
{
    case GOOGLE = 'google';

    case CUSTOM = 'custom';
}
