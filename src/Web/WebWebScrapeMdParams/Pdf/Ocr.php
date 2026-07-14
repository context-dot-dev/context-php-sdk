<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams\Pdf;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\Pdf\Ocr\UnionMember1;

/**
 * When true, detect and OCR images embedded in the selected PDF pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. This is separate from automatic scanned-PDF OCR fallback.
 *
 * @phpstan-type OcrVariants = bool|value-of<UnionMember1>
 * @phpstan-type OcrShape = OcrVariants
 */
final class Ocr implements ConverterSource
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
