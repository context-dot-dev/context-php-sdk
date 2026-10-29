<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchSubmitParams\Input\Scrape\Data;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Product options. Requires formats.product: true.
 *
 * @phpstan-type ProductParamsShape = array{
 *   dedupeImages?: bool|null, useAIFallback?: bool|null
 * }
 */
final class ProductParams implements BaseModel
{
    /** @use SdkModel<ProductParamsShape> */
    use SdkModel;

    /**
     * Drop visually duplicate product images, keeping the largest copy.
     */
    #[Optional]
    public ?bool $dedupeImages;

    /**
     * @deprecated
     *
     * Ignored. The AI fallback runs automatically.
     */
    #[Optional]
    public ?bool $useAIFallback;

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
        ?bool $dedupeImages = null,
        ?bool $useAIFallback = null
    ): self {
        $self = new self;

        null !== $dedupeImages && $self['dedupeImages'] = $dedupeImages;
        null !== $useAIFallback && $self['useAIFallback'] = $useAIFallback;

        return $self;
    }

    /**
     * Drop visually duplicate product images, keeping the largest copy.
     */
    public function withDedupeImages(bool $dedupeImages): self
    {
        $self = clone $this;
        $self['dedupeImages'] = $dedupeImages;

        return $self;
    }

    /**
     * Ignored. The AI fallback runs automatically.
     */
    public function withUseAIFallback(bool $useAIFallback): self
    {
        $self = clone $this;
        $self['useAIFallback'] = $useAIFallback;

        return $self;
    }
}
