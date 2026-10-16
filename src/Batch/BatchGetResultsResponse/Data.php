<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse;

use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage;
use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * One scrape outcome. result uses the single Scrape Anything response schema; itemId and meta identify your input.
 *
 * @phpstan-import-type ScrapedPageShape from \ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage
 * @phpstan-import-type FailedPageShape from \ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage
 *
 * @phpstan-type DataVariants = ScrapedPage|FailedPage
 * @phpstan-type DataShape = DataVariants|ScrapedPageShape|FailedPageShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'status';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['ok' => ScrapedPage::class, 'error' => FailedPage::class];
    }
}
