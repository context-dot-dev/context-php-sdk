<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse\Result;

/**
 * How relevant the result is to the query.
 */
enum Relevance: string
{
    case HIGH = 'high';

    case MEDIUM = 'medium';

    case LOW = 'low';
}
