<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesResponse\Image\Enrichment;

/**
 * Visual asset category, when classified.
 */
enum Type: string
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
