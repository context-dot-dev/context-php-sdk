<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeMdParams\IncludeHTML\UnionMember1;

/**
 * When true, the response also includes an `html` field with the page HTML the Markdown was converted from — the same body the Scrape HTML endpoint returns for the equivalent request.
 *
 * @phpstan-type IncludeHTMLVariants = bool|value-of<UnionMember1>
 * @phpstan-type IncludeHTMLShape = IncludeHTMLVariants
 */
final class IncludeHTML implements ConverterSource
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
