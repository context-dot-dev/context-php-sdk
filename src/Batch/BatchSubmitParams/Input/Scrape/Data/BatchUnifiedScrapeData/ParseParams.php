<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData;

use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams\CustomParser;
use ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams\PrebuiltParser;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Requires `formats.parse: true`; required when it is set.
 *
 * @phpstan-import-type CustomParserShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams\CustomParser
 * @phpstan-import-type PrebuiltParserShape from \ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data\BatchUnifiedScrapeData\ParseParams\PrebuiltParser
 *
 * @phpstan-type ParseParamsVariants = CustomParser|PrebuiltParser
 * @phpstan-type ParseParamsShape = ParseParamsVariants|CustomParserShape|PrebuiltParserShape
 */
final class ParseParams implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [CustomParser::class, PrebuiltParser::class];
    }
}
