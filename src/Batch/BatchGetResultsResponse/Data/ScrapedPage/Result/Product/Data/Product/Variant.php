<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Product\Data\Product;

use ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Product\Data\Product\Variant\Availability;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VariantShape = array{
 *   attributes: array<string,string>,
 *   images: list<string>,
 *   sku: string|null,
 *   url: string|null,
 *   availability?: null|\ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Product\Data\Product\Variant\Availability|value-of<\ContextDev\Batch\BatchGetResultsResponse\Data\ScrapedPage\Result\Product\Data\Product\Variant\Availability>,
 *   currency?: string|null,
 *   price?: float|null,
 * }
 */
final class Variant implements BaseModel
{
    /** @use SdkModel<VariantShape> */
    use SdkModel;

    /**
     * Attributes that define this variant, such as color, size, material, or pattern, as stated on the page.
     *
     * @var array<string,string> $attributes
     */
    #[Required(map: 'string')]
    public array $attributes;

    /**
     * Image URLs the source attaches to this variant.
     *
     * @var list<string> $images
     */
    #[Required(list: 'string')]
    public array $images;

    /**
     * SKU of this variant. `null` when the source does not state one.
     */
    #[Required]
    public ?string $sku;

    /**
     * URL of this variant or offer, when the source provides one. Several variants can share a URL.
     */
    #[Required]
    public ?string $url;

    /**
     * Stock or ordering availability of this variant.
     *
     * @var value-of<Availability>|null $availability
     */
    #[Optional(
        enum: Availability::class,
        nullable: true,
    )]
    public ?string $availability;

    /**
     * Currency code of `price`, such as `USD` or `EUR`, when stated.
     */
    #[Optional(nullable: true)]
    public ?string $currency;

    /**
     * Price of this variant, when the source states one per variant.
     */
    #[Optional(nullable: true)]
    public ?float $price;

    /**
     * `new Variant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Variant::with(attributes: ..., images: ..., sku: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Variant)->withAttributes(...)->withImages(...)->withSKU(...)->withURL(...)
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
     * @param array<string,string> $attributes
     * @param list<string> $images
     * @param Availability|value-of<Availability>|null $availability
     */
    public static function with(
        array $attributes,
        array $images,
        ?string $sku,
        ?string $url,
        Availability|string|null $availability = null,
        ?string $currency = null,
        ?float $price = null,
    ): self {
        $self = new self;

        $self['attributes'] = $attributes;
        $self['images'] = $images;
        $self['sku'] = $sku;
        $self['url'] = $url;

        null !== $availability && $self['availability'] = $availability;
        null !== $currency && $self['currency'] = $currency;
        null !== $price && $self['price'] = $price;

        return $self;
    }

    /**
     * Attributes that define this variant, such as color, size, material, or pattern, as stated on the page.
     *
     * @param array<string,string> $attributes
     */
    public function withAttributes(array $attributes): self
    {
        $self = clone $this;
        $self['attributes'] = $attributes;

        return $self;
    }

    /**
     * Image URLs the source attaches to this variant.
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
     * SKU of this variant. `null` when the source does not state one.
     */
    public function withSKU(?string $sku): self
    {
        $self = clone $this;
        $self['sku'] = $sku;

        return $self;
    }

    /**
     * URL of this variant or offer, when the source provides one. Several variants can share a URL.
     */
    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Stock or ordering availability of this variant.
     *
     * @param Availability|value-of<Availability>|null $availability
     */
    public function withAvailability(
        Availability|string|null $availability,
    ): self {
        $self = clone $this;
        $self['availability'] = $availability;

        return $self;
    }

    /**
     * Currency code of `price`, such as `USD` or `EUR`, when stated.
     */
    public function withCurrency(?string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Price of this variant, when the source states one per variant.
     */
    public function withPrice(?float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }
}
