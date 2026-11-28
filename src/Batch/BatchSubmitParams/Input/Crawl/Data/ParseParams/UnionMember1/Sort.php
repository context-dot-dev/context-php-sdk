<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\UnionMember1;

/**
 * Order of `data.reviews` for `google-maps-reviews`. `newest`, `relevant`, `highest`, and `lowest` use the same orders as Google Maps; `oldest` returns the earliest reviews first.
 */
enum Sort: string
{
    case NEWEST = 'newest';

    case OLDEST = 'oldest';

    case RELEVANT = 'relevant';

    case HIGHEST = 'highest';

    case LOWEST = 'lowest';
}
