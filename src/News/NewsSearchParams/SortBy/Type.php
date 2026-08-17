<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SortBy;

/**
 * Result ordering.
 */
enum Type: string
{
    case RELEVANCE = 'relevance';

    case NEWEST = 'newest';
}
