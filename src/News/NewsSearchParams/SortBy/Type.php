<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SortBy;

/**
 * `newest` puts the most recently published articles first; `relevance` puts the closest matches first.
 */
enum Type: string
{
    case RELEVANCE = 'relevance';

    case NEWEST = 'newest';
}
