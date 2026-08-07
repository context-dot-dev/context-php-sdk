<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams\Pdf;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\Pdf\Ocr\UnionMember1;

/**
 * When true, OCR the selected PDF pages that have no usable text layer (scans), replacing each recovered page's text with the OCR result while pages with a real text layer keep it. Billed at 1 credit per page OCR actually recovered, on top of the base request cost. When false, no OCR runs.
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
