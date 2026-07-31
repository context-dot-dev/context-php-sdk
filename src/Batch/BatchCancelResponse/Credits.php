<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * What this batch cost so far.
 *
 * @phpstan-type CreditsShape = array{reserved: int}
 */
final class Credits implements BaseModel
{
    /** @use SdkModel<CreditsShape> */
    use SdkModel;

    /**
     * Credits debited at submission. The unspent remainder is refunded once the batch settles — read `credits.refunded` from GET /batch/{batch_id} then.
     */
    #[Required]
    public int $reserved;

    /**
     * `new Credits()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Credits::with(reserved: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Credits)->withReserved(...)
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
    public static function with(int $reserved): self
    {
        $self = new self;

        $self['reserved'] = $reserved;

        return $self;
    }

    /**
     * Credits debited at submission. The unspent remainder is refunded once the batch settles — read `credits.refunded` from GET /batch/{batch_id} then.
     */
    public function withReserved(int $reserved): self
    {
        $self = clone $this;
        $self['reserved'] = $reserved;

        return $self;
    }
}
