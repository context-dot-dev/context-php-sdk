<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy;

/**
 * How to search. Only entity search is supported.
 */
enum Type: string
{
    case ENTITY = 'entity';
}
