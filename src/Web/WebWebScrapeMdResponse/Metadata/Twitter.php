<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdResponse\Metadata;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Core\Conversion\ListOf;

/**
 * @phpstan-type TwitterVariants = string|list<string>
 * @phpstan-type TwitterShape = TwitterVariants
 */
final class Twitter implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', new ListOf('string')];
    }
}
