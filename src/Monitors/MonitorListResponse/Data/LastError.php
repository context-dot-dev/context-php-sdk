<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Error from the most recent failed run; null when the last run succeeded.
 *
 * @phpstan-type LastErrorShape = array{code: string, message: string}
 */
final class LastError implements BaseModel
{
    /** @use SdkModel<LastErrorShape> */
    use SdkModel;

    #[Required]
    public string $code;

    #[Required]
    public string $message;

    /**
     * `new LastError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LastError::with(code: ..., message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LastError)->withCode(...)->withMessage(...)
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

    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
