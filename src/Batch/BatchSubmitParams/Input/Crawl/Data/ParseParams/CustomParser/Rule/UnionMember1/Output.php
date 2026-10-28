<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\CustomParser\Rule\UnionMember1;

use ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\ParseParams\CustomParser\Rule\UnionMember1\Output\UnionMember0;
use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Return text, HTML, an attribute such as `@href`, or nested field rules. Defaults to text.
 *
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
