<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Product\Data;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeResponse\Product\Data\Product\Availability;
use ContextDev\Web\WebScrapeResponse\Product\Data\Product\Variant;

/**
 * The extracted product, or null when the page is not a product detail page.
 *
 * @phpstan-import-type VariantShape from \ContextDev\Web\WebScrapeResponse\Product\Data\Product\Variant
 *
 * @phpstan-type ProductShape = array{
 *   availability: null|Availability|value-of<Availability>,
 *   brand: string|null,
 *   category: string|null,
 *   currency: string|null,
 *   description: string|null,
 *   dimensions: list<string>,
 *   features: list<string>,
 *   images: list<string>,
 *   imageURL: string|null,
 *   name: string,
 *   price: float|null,
 *   regularPrice: float|null,
 *   sku: string|null,
 *   tags: list<string>,
 *   targetAudience: list<string>,
 *   variants: list<Variant|VariantShape>,
 * }
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    /**
     * Stock or ordering availability.
     *
     * @var value-of<Availability>|null $availability
     */
    #[Required(enum: Availability::class)]
    public ?string $availability;

    /**
     * Brand or vendor.
     */
    #[Required]
    public ?string $brand;

    /**
     * Product category.
     */
    #[Required]
    public ?string $category;

    /**
     * ISO 4217 currency code.
     */
    #[Required]
    public ?string $currency;

    /**
     * Product description.
     */
    #[Required]
    public ?string $description;

    /**
     * Product dimensions as shown on the page.
     *
     * @var list<string> $dimensions
     */
    #[Required(list: 'string')]
    public array $dimensions;

    /**
     * Key features and specifications.
     *
     * @var list<string> $features
     */
    #[Required(list: 'string')]
    public array $features;

    /**
     * Product image URLs, main image first.
     *
     * @var list<string> $images
     */
    #[Required(list: 'string')]
    public array $images;

    /**
     * Main product image URL.
     */
    #[Required('imageUrl')]
    public ?string $imageURL;

    /**
     * Product name.
     */
    #[Required]
    public string $name;

    /**
     * Current price.
     */
    #[Required]
    public ?float $price;

    /**
     * List price before any discount.
     */
    #[Required]
    public ?float $regularPrice;

    /**
     * Product identifier such as a SKU or model number.
     */
    #[Required]
    public ?string $sku;

    /**
     * Product tags.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * Intended audience.
     *
     * @var list<string> $targetAudience
     */
    #[Required(list: 'string')]
    public array $targetAudience;

    /**
     * Product variations, such as different colors or sizes, with their attributes and images. Empty if none are found. May not include every variation offered by the store.
     *
     * @var list<Variant> $variants
     */
    #[Required(list: Variant::class)]
    public array $variants;

    /**
     * `new Product()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Product::with(
     *   availability: ...,
     *   brand: ...,
     *   category: ...,
     *   currency: ...,
     *   description: ...,
     *   dimensions: ...,
     *   features: ...,
     *   images: ...,
     *   imageURL: ...,
     *   name: ...,
     *   price: ...,
     *   regularPrice: ...,
     *   sku: ...,
     *   tags: ...,
     *   targetAudience: ...,
     *   variants: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Product)
     *   ->withAvailability(...)
     *   ->withBrand(...)
     *   ->withCategory(...)
     *   ->withCurrency(...)
     *   ->withDescription(...)
     *   ->withDimensions(...)
     *   ->withFeatures(...)
     *   ->withImages(...)
     *   ->withImageURL(...)
     *   ->withName(...)
     *   ->withPrice(...)
     *   ->withRegularPrice(...)
     *   ->withSKU(...)
     *   ->withTags(...)
     *   ->withTargetAudience(...)
     *   ->withVariants(...)
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
     * @param Availability|value-of<Availability>|null $availability
     * @param list<string> $dimensions
     * @param list<string> $features
     * @param list<string> $images
     * @param list<string> $tags
     * @param list<string> $targetAudience
     * @param list<Variant|VariantShape> $variants
     */
    public static function with(
        Availability|string|null $availability,
        ?string $brand,
        ?string $category,
        ?string $currency,
        ?string $description,
        array $dimensions,
        array $features,
        array $images,
        ?string $imageURL,
        string $name,
        ?float $price,
        ?float $regularPrice,
        ?string $sku,
        array $tags,
        array $targetAudience,
        array $variants,
    ): self {
        $self = new self;

        $self['availability'] = $availability;
        $self['brand'] = $brand;
        $self['category'] = $category;
        $self['currency'] = $currency;
        $self['description'] = $description;
        $self['dimensions'] = $dimensions;
        $self['features'] = $features;
        $self['images'] = $images;
        $self['imageURL'] = $imageURL;
        $self['name'] = $name;
        $self['price'] = $price;
        $self['regularPrice'] = $regularPrice;
        $self['sku'] = $sku;
        $self['tags'] = $tags;
        $self['targetAudience'] = $targetAudience;
        $self['variants'] = $variants;

        return $self;
    }

    /**
     * Stock or ordering availability.
     *
     * @param Availability|value-of<Availability>|null $availability
     */
    public function withAvailability(
        Availability|string|null $availability
    ): self {
        $self = clone $this;
        $self['availability'] = $availability;

        return $self;
    }

    /**
     * Brand or vendor.
     */
    public function withBrand(?string $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * Product category.
     */
    public function withCategory(?string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * ISO 4217 currency code.
     */
    public function withCurrency(?string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Product description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Product dimensions as shown on the page.
     *
     * @param list<string> $dimensions
     */
    public function withDimensions(array $dimensions): self
    {
        $self = clone $this;
        $self['dimensions'] = $dimensions;

        return $self;
    }

    /**
     * Key features and specifications.
     *
     * @param list<string> $features
     */
    public function withFeatures(array $features): self
    {
        $self = clone $this;
        $self['features'] = $features;

        return $self;
    }

    /**
     * Product image URLs, main image first.
     *
     * @param list<string> $images
     */
    public function withImages(array $images): self
    {
        $self = clone $this;
        $self['images'] = $images;

        return $self;
    }

    /**
     * Main product image URL.
     */
    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * Product name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Current price.
     */
    public function withPrice(?float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * List price before any discount.
     */
    public function withRegularPrice(?float $regularPrice): self
    {
        $self = clone $this;
        $self['regularPrice'] = $regularPrice;

        return $self;
    }

    /**
     * Product identifier such as a SKU or model number.
     */
    public function withSKU(?string $sku): self
    {
        $self = clone $this;
        $self['sku'] = $sku;

        return $self;
    }

    /**
     * Product tags.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Intended audience.
     *
     * @param list<string> $targetAudience
     */
    public function withTargetAudience(array $targetAudience): self
    {
        $self = clone $this;
        $self['targetAudience'] = $targetAudience;

        return $self;
    }

    /**
     * Product variations, such as different colors or sizes, with their attributes and images. Empty if none are found. May not include every variation offered by the store.
     *
     * @param list<Variant|VariantShape> $variants
     */
    public function withVariants(array $variants): self
    {
        $self = clone $this;
        $self['variants'] = $variants;

        return $self;
    }
}
