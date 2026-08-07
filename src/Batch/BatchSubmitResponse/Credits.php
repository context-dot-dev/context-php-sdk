<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * What accepting this batch cost.
 *
 * @phpstan-type CreditsShape = array{reserved: int}
 */
final class Credits implements BaseModel
{
    /** @use SdkModel<CreditsShape> */
    use SdkModel;

    /**
     * Credits just debited from your balance. Whatever the batch does not spend is refunded when it settles.
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
     * Credits just debited from your balance. Whatever the batch does not spend is refunded when it settles.
     */
    public function withReserved(int $reserved): self
    {
        $self = clone $this;
        $self['reserved'] = $reserved;

        return $self;
    }
}
