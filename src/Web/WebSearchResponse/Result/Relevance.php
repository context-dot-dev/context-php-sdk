<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse\Result;

/**
 * Relevance to the original query.
 */
enum Relevance: string
{
    case HIGH = 'high';

    case MEDIUM = 'medium';

    case LOW = 'low';
}
