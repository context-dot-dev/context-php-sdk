<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebScreenshotParams\HandleCookiePopup\UnionMember1;

/**
 * Optional parameter to control cookie/consent popup handling. If 'true', we dismiss cookie banner before capture. If 'false' or not provided, captures the page without that step.
 *
 * @phpstan-type HandleCookiePopupVariants = bool|value-of<UnionMember1>
 * @phpstan-type HandleCookiePopupShape = HandleCookiePopupVariants
 */
final class HandleCookiePopup implements ConverterSource
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
