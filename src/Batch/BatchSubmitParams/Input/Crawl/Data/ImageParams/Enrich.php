<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ImageParams;

enum Enrich: string
{
    case DIMENSIONS = 'dimensions';

    case CLASSIFICATION = 'classification';

    case FILE = 'file';
}
