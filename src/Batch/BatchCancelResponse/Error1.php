<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type Error1Shape = array{code: string, count: int}
 */
final class Error1 implements BaseModel
{
    /** @use SdkModel<Error1Shape> */
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
     * `new Error1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error1::with(code: ..., count: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error1)->withCode(...)->withCount(...)
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
