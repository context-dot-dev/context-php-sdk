<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesParams\Enrichment;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeImagesParams\Enrichment\HostedURL\UnionMember1;

/**
 * Host materializable images on the Brand.dev CDN and return their URL and MIME type.
 *
 * @phpstan-type HostedURLVariants = bool|value-of<UnionMember1>
 * @phpstan-type HostedURLShape = HostedURLVariants
 */
final class HostedURL implements ConverterSource
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
