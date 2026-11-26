<?php

declare(strict_types=1);

namespace ContextDev\Batch\CrawlControls;

use ContextDev\Batch\CrawlControls\Follow\CrawlPaginationMatcher;
use ContextDev\Batch\CrawlControls\Follow\CrawlProductMatcher;
use ContextDev\Batch\CrawlControls\Follow\CrawlRegexMatcher;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Selects links by URL pattern, by kind of page, or as the next page of a list.
 *
 * @phpstan-import-type CrawlRegexMatcherShape from \ContextDev\Batch\CrawlControls\Follow\CrawlRegexMatcher
 * @phpstan-import-type CrawlPaginationMatcherShape from \ContextDev\Batch\CrawlControls\Follow\CrawlPaginationMatcher
 * @phpstan-import-type CrawlProductMatcherShape from \ContextDev\Batch\CrawlControls\Follow\CrawlProductMatcher
 *
 * @phpstan-type FollowVariants = CrawlRegexMatcher|CrawlPaginationMatcher|CrawlProductMatcher
 * @phpstan-type FollowShape = FollowVariants|CrawlRegexMatcherShape|CrawlPaginationMatcherShape|CrawlProductMatcherShape
 */
final class Follow implements ConverterSource
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
            'pagination' => CrawlPaginationMatcher::class,
            'product' => CrawlProductMatcher::class,
        ];
    }
}
