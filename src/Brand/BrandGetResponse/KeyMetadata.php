<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Credit usage, included whenever a valid API key is provided.
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
     * Credits used by this request.
     */
    #[Required('credits_consumed')]
    public int $creditsConsumed;

    /**
     * Credits remaining for your organization.
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
     * Credits used by this request.
     */
    public function withCreditsConsumed(int $creditsConsumed): self
    {
        $self = clone $this;
        $self['creditsConsumed'] = $creditsConsumed;

        return $self;
    }

    /**
     * Credits remaining for your organization.
     */
    public function withCreditsRemaining(int $creditsRemaining): self
    {
        $self = clone $this;
        $self['creditsRemaining'] = $creditsRemaining;

        return $self;
    }
}
