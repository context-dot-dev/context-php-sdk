<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls;

use ContextDev\Batch\CrawlControls\Scrape\CrawlProductMatcher;
use ContextDev\Batch\CrawlControls\Scrape\CrawlRegexMatcher;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Selects pages by URL pattern or by kind of page.
 *
 * @phpstan-import-type CrawlRegexMatcherShape from \ContextDev\Batch\CrawlControls\Scrape\CrawlRegexMatcher
 * @phpstan-import-type CrawlProductMatcherShape from \ContextDev\Batch\CrawlControls\Scrape\CrawlProductMatcher
 *
 * @phpstan-type ScrapeVariants = CrawlRegexMatcher|CrawlProductMatcher
 * @phpstan-type ScrapeShape = ScrapeVariants|CrawlRegexMatcherShape|CrawlProductMatcherShape
 */
final class Scrape implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'kind';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'regex' => CrawlRegexMatcher::class,
            'product' => CrawlProductMatcher::class,
        ];
    }
}
