<?php

declare(strict_types=1);

namespace ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByDomain;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByIsin;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByName;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByTicker;

/**
 * The company to search news for, identified by name, domain, ticker, or ISIN.
 *
 * @phpstan-import-type NewsSearchEntityByNameShape from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByName
 * @phpstan-import-type NewsSearchEntityByDomainShape from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByDomain
 * @phpstan-import-type NewsSearchEntityByTickerShape from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByTicker
 * @phpstan-import-type NewsSearchEntityByIsinShape from \ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity\Entity\NewsSearchEntityByIsin
 *
 * @phpstan-type EntityVariants = NewsSearchEntityByName|NewsSearchEntityByDomain|NewsSearchEntityByTicker|NewsSearchEntityByIsin
 * @phpstan-type EntityShape = EntityVariants|NewsSearchEntityByNameShape|NewsSearchEntityByDomainShape|NewsSearchEntityByTickerShape|NewsSearchEntityByIsinShape
 */
final class Entity implements ConverterSource
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
            'name' => NewsSearchEntityByName::class,
            'domain' => NewsSearchEntityByDomain::class,
            'ticker' => NewsSearchEntityByTicker::class,
            'isin' => NewsSearchEntityByIsin::class,
        ];
    }
}
