<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * A failure of the batch as a whole, distinct from the per-page failures in `page_errors`.
 *
 * @phpstan-type FailureShape = array{code: string, message: string}
 */
final class Failure implements BaseModel
{
    /** @use SdkModel<FailureShape> */
    use SdkModel;

    /**
     * Why the batch itself stopped.
     */
    #[Required]
    public string $code;

    /**
     * Human-readable explanation.
     */
    #[Required]
    public string $message;

    /**
     * `new Failure()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Failure::with(code: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Failure)->withCode(...)->withMessage(...)
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
    public static function with(string $code, string $message): self
    {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Why the batch itself stopped.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Human-readable explanation.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
