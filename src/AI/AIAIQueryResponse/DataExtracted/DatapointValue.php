<?php

declare(strict_types=1);

namespace ContextDev\AI\AIAIQueryResponse\DataExtracted;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;

/**
 * Value of the extracted data point. Can be a primitive type, an array of primitives, or an array of objects when datapoint_list_type is 'object'.
 *
 * @phpstan-type DatapointValueVariants = string|float|bool|list<string>|list<float>|list<mixed>
 * @phpstan-type DatapointValueShape = DatapointValueVariants
 */
final class DatapointValue implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'string',
            'float',
            'bool',
            new ListOf('string'),
            new ListOf('float'),
            new ListOf('mixed'),
        ];
    }
}
