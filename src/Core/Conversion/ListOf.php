<?php

declare(strict_types=1);

namespace ContextDev\Core\Conversion;

use ContextDev\Core\Conversion\Concerns\ArrayOf;
use ContextDev\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
