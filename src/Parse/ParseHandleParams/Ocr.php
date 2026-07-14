<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Parse\ParseHandleParams\Ocr\UnionMember1;

/**
 * When true for PDF inputs, detect and OCR images embedded in the selected pages, inserting recognized text at each image's position in page reading order while preserving the PDF text layer. pdf.start/pdf.end limit the inclusive page range. When false, all OCR is disabled, including the automatic scanned-PDF fallback.
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
