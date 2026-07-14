<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesParams\Enrichment;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment\Classification\UnionMember1;

/**
 * Classify each image by visual asset type.
 *
 * @phpstan-type ClassificationVariants = bool|value-of<UnionMember1>
 * @phpstan-type ClassificationShape = ClassificationVariants
 */
final class Classification implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', UnionMember1::class];
    }
}
