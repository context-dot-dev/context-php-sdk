<?php

declare(strict_types=1);

namespace ContextDev\Core\Conversion\Contracts;

use ContextDev\Core\Conversion\CoerceState;
use ContextDev\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
