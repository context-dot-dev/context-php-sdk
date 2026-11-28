<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;

/**
 * Comma-separated tags. Returns batches that have any of them. You can also repeat the `tags` parameter.
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
