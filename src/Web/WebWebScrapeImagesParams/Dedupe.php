<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeImagesParams;

use ContextDev\Core\Concerns\SdkUnion;
use ContextDev\Core\Conversion\Contracts\Converter;
use ContextDev\Core\Conversion\Contracts\ConverterSource;
use ContextDev\Web\WebWebScrapeImagesParams\Dedupe\UnionMember1;

/**
 * When true, visually duplicate images are removed: every image is loaded and perceptually hashed, and only the highest-resolution copy of each duplicate group is kept. Images that cannot be downloaded or hashed are kept. Default: false.
 *
 * @phpstan-type DedupeVariants = bool|value-of<UnionMember1>
 * @phpstan-type DedupeShape = DedupeVariants
 */
final class Dedupe implements ConverterSource
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
