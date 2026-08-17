<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\FilterBy;

enum ArticleType: string
{
    case EDITORIAL = 'editorial';

    case PRESS_RELEASE = 'press_release';

    case REGULATORY_FILING = 'regulatory_filing';

    case ADVISORY = 'advisory';
}
