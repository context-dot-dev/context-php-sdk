<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ParseParams\UnionMember1;

/**
 * google-maps-reviews only. Order of data.reviews. newest, relevant, highest, and lowest follow Google; oldest returns the earliest reviews first, which Google itself does not offer.
 */
enum Sort: string
{
    case NEWEST = 'newest';

    case OLDEST = 'oldest';

    case RELEVANT = 'relevant';

    case HIGHEST = 'highest';

    case LOWEST = 'lowest';
}
