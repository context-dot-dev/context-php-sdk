<?php

declare(strict_types=1);

namespace ContextDev\AI\AIExtractProductsResponse;

use ContextDev\AI\AIExtractProductsResponse\Product\BillingFrequency;
use ContextDev\AI\AIExtractProductsResponse\Product\PricingModel;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProductShape = array{
 *   description: string,
 *   features: list<string>,
 *   images: list<string>,
 *   name: string,
 *   sku: string|null,
 *   tags: list<string>,
 *   targetAudience: list<string>,
 *   billingFrequency?: null|BillingFrequency|value-of<BillingFrequency>,
 *   category?: string|null,
 *   currency?: string|null,
 *   imageURL?: string|null,
 *   price?: float|null,
 *   pricingModel?: null|PricingModel|value-of<PricingModel>,
 *   url?: string|null,
 * }
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    /**
     * Description of the product.
     */
    #[Required]
    public string $description;

    /**
     * List of product features.
     *
     * @var list<string> $features
     */
    #[Required(list: 'string')]
    public array $features;

    /**
     * URLs to product images on the page (up to 7).
     *
     * @var list<string> $images
     */
    #[Required(list: 'string')]
    public array $images;

    /**
     * Name of the product.
     */
    #[Required]
    public string $name;

    /**
     * Stock Keeping Unit (product identifier). Null if no identifier is found.
     */
    #[Required]
    public ?string $sku;

    /**
     * Tags associated with the product.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * Target audience for the product (array of strings).
     *
     * @var list<string> $targetAudience
     */
    #[Required('target_audience', list: 'string')]
    public array $targetAudience;

    /**
     * Billing frequency for the product.
     *
     * @var value-of<BillingFrequency>|null $billingFrequency
     */
    #[Optional(
        'billing_frequency',
        enum: BillingFrequency::class,
        nullable: true
    )]
    public ?string $billingFrequency;

    /**
     * Category of the product.
     */
    #[Optional(nullable: true)]
    public ?string $category;

    /**
     * Currency code for the price (e.g., USD, EUR).
     */
    #[Optional(nullable: true)]
    public ?string $currency;

    /**
     * URL to the product image.
     */
    #[Optional('image_url', nullable: true)]
    public ?string $imageURL;

    /**
     * Price of the product.
     */
    #[Optional(nullable: true)]
    public ?float $price;

    /**
     * Pricing model for the product.
     *
     * @var value-of<PricingModel>|null $pricingModel
     */
    #[Optional('pricing_model', enum: PricingModel::class, nullable: true)]
    public ?string $pricingModel;

    /**
     * URL to the product page.
     */
    #[Optional(nullable: true)]
    public ?string $url;

    /**
     * `new Product()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Product::with(
     *   description: ...,
     *   features: ...,
     *   images: ...,
     *   name: ...,
     *   sku: ...,
     *   tags: ...,
     *   targetAudience: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Product)
     *   ->withDescription(...)
     *   ->withFeatures(...)
     *   ->withImages(...)
     *   ->withName(...)
     *   ->withSKU(...)
     *   ->withTags(...)
     *   ->withTargetAudience(...)
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
     * @param list<string> $features
     * @param list<string> $images
     * @param list<string> $tags
     * @param list<string> $targetAudience
     * @param BillingFrequency|value-of<BillingFrequency>|null $billingFrequency
     * @param PricingModel|value-of<PricingModel>|null $pricingModel
     */
    public static function with(
        string $description,
        array $features,
        array $images,
        string $name,
        ?string $sku,
        array $tags,
        array $targetAudience,
        BillingFrequency|string|null $billingFrequency = null,
        ?string $category = null,
        ?string $currency = null,
        ?string $imageURL = null,
        ?float $price = null,
        PricingModel|string|null $pricingModel = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['features'] = $features;
        $self['images'] = $images;
        $self['name'] = $name;
        $self['sku'] = $sku;
        $self['tags'] = $tags;
        $self['targetAudience'] = $targetAudience;

        null !== $billingFrequency && $self['billingFrequency'] = $billingFrequency;
        null !== $category && $self['category'] = $category;
        null !== $currency && $self['currency'] = $currency;
        null !== $imageURL && $self['imageURL'] = $imageURL;
        null !== $price && $self['price'] = $price;
        null !== $pricingModel && $self['pricingModel'] = $pricingModel;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Description of the product.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * List of product features.
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
     * URLs to product images on the page (up to 7).
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
     * Name of the product.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Stock Keeping Unit (product identifier). Null if no identifier is found.
     */
    public function withSKU(?string $sku): self
    {
        $self = clone $this;
        $self['sku'] = $sku;

        return $self;
    }

    /**
     * Tags associated with the product.
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
     * Target audience for the product (array of strings).
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
     * Billing frequency for the product.
     *
     * @param BillingFrequency|value-of<BillingFrequency>|null $billingFrequency
     */
    public function withBillingFrequency(
        BillingFrequency|string|null $billingFrequency
    ): self {
        $self = clone $this;
        $self['billingFrequency'] = $billingFrequency;

        return $self;
    }

    /**
     * Category of the product.
     */
    public function withCategory(?string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Currency code for the price (e.g., USD, EUR).
     */
    public function withCurrency(?string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * URL to the product image.
     */
    public function withImageURL(?string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * Price of the product.
     */
    public function withPrice(?float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Pricing model for the product.
     *
     * @param PricingModel|value-of<PricingModel>|null $pricingModel
     */
    public function withPricingModel(
        PricingModel|string|null $pricingModel
    ): self {
        $self = clone $this;
        $self['pricingModel'] = $pricingModel;

        return $self;
    }

    /**
     * URL to the product page.
     */
    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
