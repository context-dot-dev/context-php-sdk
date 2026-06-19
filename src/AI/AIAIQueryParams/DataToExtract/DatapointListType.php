<?php

declare(strict_types=1);

namespace ContextDev\AI\AIAIQueryParams\DataToExtract;

/**
 * Type of items in the list when datapoint_type is 'list'. Defaults to 'string'. Use 'object' to extract an array of objects matching a schema.
 */
enum DatapointListType: string
{
    case STRING = 'string';

    case TEXT = 'text';

    case NUMBER = 'number';

    case DATE = 'date';

    case BOOLEAN = 'boolean';

    case LIST = 'list';

    case URL = 'url';

    case OBJECT = 'object';
}
