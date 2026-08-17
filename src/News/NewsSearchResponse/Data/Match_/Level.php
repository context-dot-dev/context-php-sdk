<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse\Data\Match_;

/**
 * primary when the article is mainly about the company, secondary when the company is mentioned but is not the main subject.
 */
enum Level: string
{
    case PRIMARY = 'primary';

    case SECONDARY = 'secondary';
}
