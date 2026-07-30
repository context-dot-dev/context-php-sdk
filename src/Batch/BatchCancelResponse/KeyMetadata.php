<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * API key usage for this request.
 *
 * @phpstan-type KeyMetadataShape = array{
 *   creditsConsumed: int, creditsRemaining: int
 * }
 */
final class KeyMetadata implements BaseModel
{
    /** @use SdkModel<KeyMetadataShape> */
    use SdkModel;

    /**
     * The number of credits consumed by this request.
     */
    #[Required('credits_consumed')]
    public int $creditsConsumed;

    /**
     * The number of credits remaining for your organization after this request.
     */
    #[Required('credits_remaining')]
    public int $creditsRemaining;

    /**
     * `new KeyMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyMetadata::with(creditsConsumed: ..., creditsRemaining: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyMetadata)->withCreditsConsumed(...)->withCreditsRemaining(...)
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
    public static function with(
        int $creditsConsumed,
        int $creditsRemaining
    ): self {
        $self = new self;

        $self['creditsConsumed'] = $creditsConsumed;
        $self['creditsRemaining'] = $creditsRemaining;

        return $self;
    }

    /**
     * The number of credits consumed by this request.
     */
    public function withCreditsConsumed(int $creditsConsumed): self
    {
        $self = clone $this;
        $self['creditsConsumed'] = $creditsConsumed;

        return $self;
    }

    /**
     * The number of credits remaining for your organization after this request.
     */
    public function withCreditsRemaining(int $creditsRemaining): self
    {
        $self = clone $this;
        $self['creditsRemaining'] = $creditsRemaining;

        return $self;
    }
}
