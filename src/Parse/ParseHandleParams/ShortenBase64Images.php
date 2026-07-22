<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Parse\ParseHandleParams\ShortenBase64Images\UnionMember1;

/**
 * Shorten base64-encoded image data in the Markdown output.
 *
 * @phpstan-type ShortenBase64ImagesVariants = bool|value-of<UnionMember1>
 * @phpstan-type ShortenBase64ImagesShape = ShortenBase64ImagesVariants
 */
final class ShortenBase64Images implements ConverterSource
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
