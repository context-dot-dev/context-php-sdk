<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByNaturalLanguage;

/**
 * What to search for: a specific company, or a natural-language query across all news.
 *
 * @phpstan-import-type NewsSearchByNaturalLanguageShape from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByNaturalLanguage
 * @phpstan-import-type NewsSearchByEntityShape from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity
 *
 * @phpstan-type SearchByVariants = NewsSearchByNaturalLanguage|NewsSearchByEntity
 * @phpstan-type SearchByShape = SearchByVariants|NewsSearchByNaturalLanguageShape|NewsSearchByEntityShape
 */
final class SearchBy implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'natural_language' => NewsSearchByNaturalLanguage::class,
            'entity' => NewsSearchByEntity::class,
        ];
    }
}
