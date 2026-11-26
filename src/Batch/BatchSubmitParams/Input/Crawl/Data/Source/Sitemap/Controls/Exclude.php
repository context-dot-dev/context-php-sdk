<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Exclude\CrawlProductMatcher;
use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Exclude\CrawlRegexMatcher;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Selects pages by URL pattern or by kind of page.
 *
 * @phpstan-import-type CrawlRegexMatcherShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Exclude\CrawlRegexMatcher
 * @phpstan-import-type CrawlProductMatcherShape from \ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\Source\Sitemap\Controls\Exclude\CrawlProductMatcher
 *
 * @phpstan-type ExcludeVariants = CrawlRegexMatcher|CrawlProductMatcher
 * @phpstan-type ExcludeShape = ExcludeVariants|CrawlRegexMatcherShape|CrawlProductMatcherShape
 */
final class Exclude implements ConverterSource
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
