<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListParams;

enum SearchBy: string
{
    case NAME = 'name';

    case URL = 'url';

    case INSTRUCTIONS = 'instructions';

    case TAGS = 'tags';
}
