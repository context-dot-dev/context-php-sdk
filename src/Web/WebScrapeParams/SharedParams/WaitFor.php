<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * After actions, wait this many milliseconds or until a CSS selector is visible. Defaults to 500 ms, or 2000 ms with frames or an XML URL. Set 0 to skip.
 *
 * @phpstan-type WaitForVariants = int|string
 * @phpstan-type WaitForShape = WaitForVariants
 */
final class WaitFor implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['int', 'string'];
    }
}
