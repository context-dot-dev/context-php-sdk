<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchResponse\Data\Match_;

enum Level: string
{
    case PRIMARY = 'primary';

    case SECONDARY = 'secondary';
}
