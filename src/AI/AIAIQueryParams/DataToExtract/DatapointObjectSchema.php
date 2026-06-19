<?php

declare(strict_types=1);

namespace ContextDev\AI\AIAIQueryParams\DataToExtract;

enum DatapointObjectSchema: string
{
    case STRING = 'string';

    case NUMBER = 'number';

    case DATE = 'date';

    case BOOLEAN = 'boolean';
}
