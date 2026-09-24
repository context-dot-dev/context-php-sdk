<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Product options. Requires formats.product: true.
 *
 * @phpstan-type ProductParamsShape = array{useAIFallback?: bool|null}
 */
final class ProductParams implements BaseModel
{
    /** @use SdkModel<ProductParamsShape> */
    use SdkModel;

    /**
     * Extract the product with a specialized model when the page has no structured product data. Adds six credits when the model verdict is returned successfully. If the fallback fails, the product output has success: false and data: null with no fallback charge; other outputs remain available. Request deadlines and client disconnects still apply.
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
    public static function with(?bool $useAIFallback = null): self
    {
        $self = new self;

        null !== $useAIFallback && $self['useAIFallback'] = $useAIFallback;

        return $self;
    }

    /**
     * Extract the product with a specialized model when the page has no structured product data. Adds six credits when the model verdict is returned successfully. If the fallback fails, the product output has success: false and data: null with no fallback charge; other outputs remain available. Request deadlines and client disconnects still apply.
     */
    public function withUseAIFallback(bool $useAIFallback): self
    {
        $self = clone $this;
        $self['useAIFallback'] = $useAIFallback;

        return $self;
    }
}
