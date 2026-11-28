<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Crawl\Data\SharedParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;

/**
 * Time to wait after actions, in milliseconds, or a CSS selector to wait for. Defaults to 500 ms, or 2000 ms when `includeFrames` is `true` or the URL ends in `.xml`.
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
