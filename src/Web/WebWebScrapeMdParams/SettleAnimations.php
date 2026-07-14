<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\SettleAnimations\UnionMember1;

/**
 * When true, waits briefly for CSS and transition animations to settle before converting to Markdown. Defaults to false. This adds a bit of latency in exchange for more stable output on animated pages.
 *
 * @phpstan-type SettleAnimationsVariants = bool|value-of<UnionMember1>
 * @phpstan-type SettleAnimationsShape = SettleAnimationsVariants
 */
final class SettleAnimations implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', UnionMember1::class];
    }
}
