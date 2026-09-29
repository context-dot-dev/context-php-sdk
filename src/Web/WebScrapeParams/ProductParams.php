<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Product options. Requires formats.product: true.
 *
 * @phpstan-type ProductParamsShape = array{dedupeImages?: bool|null}
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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $dedupeImages = null): self
    {
        $self = new self;

        null !== $dedupeImages && $self['dedupeImages'] = $dedupeImages;

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
}
