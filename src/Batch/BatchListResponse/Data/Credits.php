<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchListResponse\Data;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Reserved and used credits.
 *
 * @phpstan-type CreditsShape = array{charged: int, estimated: int}
 */
final class Credits implements BaseModel
{
    /** @use SdkModel<CreditsShape> */
    use SdkModel;

    /**
     * Credits used by successful pages.
     */
    #[Required]
    public int $charged;

    /**
     * Credits reserved when the batch was accepted.
     */
    #[Required]
    public int $estimated;

    /**
     * `new Credits()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Credits::with(charged: ..., estimated: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Credits)->withCharged(...)->withEstimated(...)
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
    public static function with(int $charged, int $estimated): self
    {
        $self = new self;

        $self['charged'] = $charged;
        $self['estimated'] = $estimated;

        return $self;
    }

    /**
     * Credits used by successful pages.
     */
    public function withCharged(int $charged): self
    {
        $self = clone $this;
        $self['charged'] = $charged;

        return $self;
    }

    /**
     * Credits reserved when the batch was accepted.
     */
    public function withEstimated(int $estimated): self
    {
        $self = clone $this;
        $self['estimated'] = $estimated;

        return $self;
    }
}
