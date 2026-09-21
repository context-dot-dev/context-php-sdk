<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ImageParams;

enum Enrich: string
{
    case DIMENSIONS = 'dimensions';

    case CLASSIFICATION = 'classification';

    case FILE = 'file';
}
