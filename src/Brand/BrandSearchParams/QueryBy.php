<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandSearchParams;

enum QueryBy: string
{
    case NAME = 'name';

    case DOMAIN = 'domain';
}
