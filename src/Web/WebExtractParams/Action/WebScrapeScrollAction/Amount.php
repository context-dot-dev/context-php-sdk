<?php

declare(strict_types=1);

namespace ContextDev\Web\WebExtractParams\Action\WebScrapeScrollAction;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebExtractParams\Action\WebScrapeScrollAction\Amount\UnionMember1;

/**
 * Pixels per scroll, one visible viewport, or the current scroll boundary. Defaults to viewport.
 *
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
