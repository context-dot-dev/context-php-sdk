<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls;

use ContextDev\Batch\CrawlControls\Source\Sitemap;
use ContextDev\Batch\CrawlControls\Source\StartURL;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Where the crawl started.
 *
 * @phpstan-import-type StartURLShape from \ContextDev\Batch\CrawlControls\Source\StartURL
 * @phpstan-import-type SitemapShape from \ContextDev\Batch\CrawlControls\Source\Sitemap
 *
 * @phpstan-type SourceVariants = StartURL|Sitemap
 * @phpstan-type SourceShape = SourceVariants|StartURLShape|SitemapShape
 */
final class Source implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [StartURL::class, Sitemap::class];
    }
}
