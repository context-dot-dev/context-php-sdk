<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScrapeParams\SharedParams\Action\Scroll\Amount\UnionMember1;

/**
 * @phpstan-type AmountVariants = int|value-of<UnionMember1>
 * @phpstan-type AmountShape = AmountVariants
 */
final class Amount implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['int', UnionMember1::class];
    }
}
