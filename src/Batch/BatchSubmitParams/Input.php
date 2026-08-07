<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Choose a URL list or a site crawl.
 *
 * @phpstan-import-type ScrapeShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape
 * @phpstan-import-type CrawlShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl
 *
 * @phpstan-type InputVariants = Scrape|Crawl
 * @phpstan-type InputShape = InputVariants|ScrapeShape|CrawlShape
 */
final class Input implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'mode';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['scrape' => Scrape::class, 'crawl' => Crawl::class];
    }
}
