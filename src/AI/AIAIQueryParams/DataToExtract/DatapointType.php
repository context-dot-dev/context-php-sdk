<?php

declare(strict_types=1);

namespace ContextDev\AI\AIAIQueryParams\DataToExtract;

/**
 * Type of the data point.
 */
enum DatapointType: string
{
    case TEXT = 'text';

    case NUMBER = 'number';

    case DATE = 'date';

    case BOOLEAN = 'boolean';

    case LIST = 'list';

    case URL = 'url';
}
