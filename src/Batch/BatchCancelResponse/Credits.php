<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * What this batch has done to your credit balance.
 *
 * @phpstan-type CreditsShape = array{net: int, refunded: int, reserved: int}
 */
final class Credits implements BaseModel
{
    /** @use SdkModel<CreditsShape> */
    use SdkModel;

    /**
     * `reserved` minus `refunded` — what the batch has cost so far. Equal to `reserved` until the batch settles.
     */
    #[Required]
    public int $net;

    /**
     * Credits returned for pages that did not succeed. Stays 0 until the batch reaches a final status, then settles in one movement.
     */
    #[Required]
    public int $refunded;

    /**
     * Credits debited from your balance the moment the batch was accepted. This is a charge, not a forecast — the whole amount leaves the balance up front.
     */
    #[Required]
    public int $reserved;

    /**
     * `new Credits()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Credits::with(net: ..., refunded: ..., reserved: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Credits)->withNet(...)->withRefunded(...)->withReserved(...)
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
    public static function with(int $net, int $refunded, int $reserved): self
    {
        $self = new self;

        $self['net'] = $net;
        $self['refunded'] = $refunded;
        $self['reserved'] = $reserved;

        return $self;
    }

    /**
     * `reserved` minus `refunded` — what the batch has cost so far. Equal to `reserved` until the batch settles.
     */
    public function withNet(int $net): self
    {
        $self = clone $this;
        $self['net'] = $net;

        return $self;
    }

    /**
     * Credits returned for pages that did not succeed. Stays 0 until the batch reaches a final status, then settles in one movement.
     */
    public function withRefunded(int $refunded): self
    {
        $self = clone $this;
        $self['refunded'] = $refunded;

        return $self;
    }

    /**
     * Credits debited from your balance the moment the batch was accepted. This is a charge, not a forecast — the whole amount leaves the balance up front.
     */
    public function withReserved(int $reserved): self
    {
        $self = clone $this;
        $self['reserved'] = $reserved;

        return $self;
    }
}
