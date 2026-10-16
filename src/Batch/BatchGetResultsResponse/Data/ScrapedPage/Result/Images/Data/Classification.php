<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Images\Data;

enum Classification: string
{
    case PHOTOGRAPHY = 'photography';

    case ILLUSTRATION = 'illustration';

    case LOGO = 'logo';

    case WORDMARK = 'wordmark';

    case ICON = 'icon';

    case PATTERN = 'pattern';

    case GRAPHIC = 'graphic';

    case OTHER = 'other';
}
