<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse\Data;

enum Type: string
{
    case EDITORIAL = 'editorial';

    case PRESS_RELEASE = 'press_release';

    case REGULATORY_FILING = 'regulatory_filing';

    case ADVISORY = 'advisory';
}
