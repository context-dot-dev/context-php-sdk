<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Product;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeResponse\Product\Data\Product;

/**
 * @phpstan-import-type ProductShape from \ContextDev\Web\WebScrapeResponse\Product\Data\Product
 *
 * @phpstan-type DataShape = array{
 *   isProductPage: bool, product: null|Product|ProductShape
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Whether the page is a product detail page.
     */
    #[Required]
    public bool $isProductPage;

    /**
     * The extracted product, or null when the page is not a product detail page.
     */
    #[Required]
    public ?Product $product;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(isProductPage: ..., product: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withIsProductPage(...)->withProduct(...)
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
     *
     * @param Product|ProductShape|null $product
     */
    public static function with(
        bool $isProductPage,
        Product|array|null $product
    ): self {
        $self = new self;

        $self['isProductPage'] = $isProductPage;
        $self['product'] = $product;

        return $self;
    }

    /**
     * Whether the page is a product detail page.
     */
    public function withIsProductPage(bool $isProductPage): self
    {
        $self = clone $this;
        $self['isProductPage'] = $isProductPage;

        return $self;
    }

    /**
     * The extracted product, or null when the page is not a product detail page.
     *
     * @param Product|ProductShape|null $product
     */
    public function withProduct(Product|array|null $product): self
    {
        $self = clone $this;
        $self['product'] = $product;

        return $self;
    }
}
