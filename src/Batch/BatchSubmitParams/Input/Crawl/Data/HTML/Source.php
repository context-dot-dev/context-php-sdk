<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\Sitemap;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\StartURL;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * How to find pages to crawl.
 *
 * @phpstan-import-type StartURLShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\StartURL
 * @phpstan-import-type SitemapShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\HTML\Source\Sitemap
 *
 * @phpstan-type SourceVariants = StartURL|Sitemap
 * @phpstan-type SourceShape = SourceVariants|StartURLShape|SitemapShape
 */
final class Source implements ConverterSource
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
        return ['start_url' => StartURL::class, 'sitemap' => Sitemap::class];
    }
}
