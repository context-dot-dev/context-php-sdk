<?php

declare(strict_types=1);

namespace ContextDev\Scholar\ScholarSearchParams;

/**
 * `relevance` puts the closest matches first; `date_desc` puts the newest papers first, with undated papers last. Both orders apply to the top 250 matches.
 */
enum Sort: string
{
    case RELEVANCE = 'relevance';

    case DATE_DESC = 'date_desc';
}
