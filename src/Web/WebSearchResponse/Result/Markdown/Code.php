<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse\Result\Markdown;

/**
 * Per-result scrape outcome. Inspect this before reading `markdown`.
 */
enum Code: string
{
    case SUCCESS = 'SUCCESS';

    case NOT_REQUESTED = 'NOT_REQUESTED';

    case TIMEOUT = 'TIMEOUT';

    case WEBSITE_ACCESS_ERROR = 'WEBSITE_ACCESS_ERROR';

    case ERROR = 'ERROR';
}
