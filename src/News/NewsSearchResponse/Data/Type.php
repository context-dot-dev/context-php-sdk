<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse\Data;

/**
 * Kind of coverage. Use it to separate independent reporting (editorial) from company-issued content (press_release, regulatory_filing, advisory).
 */
enum Type: string
{
    case EDITORIAL = 'editorial';

    case PRESS_RELEASE = 'press_release';

    case REGULATORY_FILING = 'regulatory_filing';

    case ADVISORY = 'advisory';
}
