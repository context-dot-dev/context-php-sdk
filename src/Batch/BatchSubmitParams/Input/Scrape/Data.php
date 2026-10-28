<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Pages to scrape and their output format.
 *
 * @phpstan-import-type MarkdownShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\Markdown
 * @phpstan-import-type HTMLShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\HTML
 * @phpstan-import-type BatchUnifiedScrapeDataShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData
 *
 * @phpstan-type DataVariants = Markdown|HTML|BatchUnifiedScrapeData
 * @phpstan-type DataShape = DataVariants|MarkdownShape|HTMLShape|BatchUnifiedScrapeDataShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Markdown::class, HTML::class, BatchUnifiedScrapeData::class];
    }
}
