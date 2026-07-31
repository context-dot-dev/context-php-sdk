<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Page failures sharing one error code.
 *
 * @phpstan-type ErrorCountShape = array{code: string, count: int}
 */
final class ErrorCount implements BaseModel
{
    /** @use SdkModel<ErrorCountShape> */
    use SdkModel;

    /**
     * Error code for these failures.
     */
    #[Required]
    public string $code;

    /**
     * Pages that failed with this code.
     */
    #[Required]
    public int $count;

    /**
     * `new ErrorCount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ErrorCount::with(code: ..., count: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ErrorCount)->withCode(...)->withCount(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $code, int $count): self
    {
        $self = new self;

        $self['code'] = $code;
        $self['count'] = $count;

        return $self;
    }

    /**
     * Error code for these failures.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Pages that failed with this code.
     */
    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }
}
