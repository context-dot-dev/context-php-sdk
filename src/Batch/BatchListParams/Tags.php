<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;

/**
 * Tags to filter by (matches batches having any of them). Pass repeated `tags` params or one comma-separated list, e.g. `tags=docs,competitor`.
 *
 * @phpstan-type TagsVariants = string|list<string>
 * @phpstan-type TagsShape = TagsVariants
 */
final class Tags implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', new ListOf('string')];
    }
}
