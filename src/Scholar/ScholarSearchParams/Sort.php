<?php

declare(strict_types=1);

namespace ContextDev\Scholar\ScholarSearchParams;

/**
 * Order the top 250 matches. date_desc puts newest first, with undated papers last.
 */
enum Sort: string
{
    case RELEVANCE = 'relevance';

    case DATE_DESC = 'date_desc';
}
