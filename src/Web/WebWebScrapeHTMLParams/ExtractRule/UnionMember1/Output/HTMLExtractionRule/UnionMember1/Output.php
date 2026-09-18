<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1\Output\HTMLExtractionRule\UnionMember1;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeHTMLParams\ExtractRule\UnionMember1\Output\HTMLExtractionRule\UnionMember1\Output\UnionMember0;

/**
 * @phpstan-type OutputVariants = mixed|string|value-of<UnionMember0>
 * @phpstan-type OutputShape = OutputVariants
 */
final class Output implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, 'string', 'mixed'];
    }
}
