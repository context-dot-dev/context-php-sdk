<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\MapOf;
use ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1\Output\HTMLExtractionRule;
use ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1\Output\HTMLExtractionRule\UnionMember1;
use ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1\Output\UnionMember0;

/**
 * @phpstan-import-type HTMLExtractionRuleShape from \ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1\Output\HTMLExtractionRule
 *
 * @phpstan-type OutputVariants = string|value-of<UnionMember0>|array<string,string|UnionMember1>
 * @phpstan-type OutputShape = OutputVariants|array<string,HTMLExtractionRuleShape>
 */
final class Output implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            UnionMember0::class, 'string', new MapOf(HTMLExtractionRule::class),
        ];
    }
}
