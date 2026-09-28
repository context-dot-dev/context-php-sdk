<?php

declare(strict_types=1);

namespace ContextDev\Web\WebSearchResponse\Result\Highlights;

/**
 * Per-result highlights outcome. Inspect this before reading `highlights`.
 */
enum Code: string
{
    case SUCCESS = 'SUCCESS';

    case NOT_REQUESTED = 'NOT_REQUESTED';

    case TIMEOUT = 'TIMEOUT';

    case CONTENT_TOO_LARGE = 'CONTENT_TOO_LARGE';

    case WEBSITE_ACCESS_ERROR = 'WEBSITE_ACCESS_ERROR';

    case ERROR = 'ERROR';
}
