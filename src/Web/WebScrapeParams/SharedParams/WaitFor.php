<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\SharedParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Milliseconds, or a CSS selector to wait for, after actions. Defaults to 500 (2000 with frames or XML).
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
