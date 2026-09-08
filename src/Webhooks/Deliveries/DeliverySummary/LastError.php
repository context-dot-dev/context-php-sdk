<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\DeliverySummary;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Latest delivery error, or null if none.
 *
 * @phpstan-type LastErrorShape = array{code: string, message: string}
 */
final class LastError implements BaseModel
{
    /** @use SdkModel<LastErrorShape> */
    use SdkModel;

    /**
     * Error code.
     */
    #[Required]
    public string $code;

    /**
     * Error details.
     */
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

    /**
     * Error code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Error details.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
