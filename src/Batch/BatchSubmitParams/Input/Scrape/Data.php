<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape;

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
 *
 * @phpstan-type DataVariants = Markdown|HTML
 * @phpstan-type DataShape = DataVariants|MarkdownShape|HTMLShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'format';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['markdown' => Markdown::class, 'html' => HTML::class];
    }
}
