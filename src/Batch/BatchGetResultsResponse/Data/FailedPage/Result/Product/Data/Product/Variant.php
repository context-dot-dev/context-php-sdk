<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Product\Data\Product;

use ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Product\Data\Product\Variant\Availability;
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
 *   availability?: null|\ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Product\Data\Product\Variant\Availability|value-of<\ContextDev\Batch\BatchGetResultsResponse\Data\FailedPage\Result\Product\Data\Product\Variant\Availability>,
 *   currency?: string|null,
 *   price?: float|null,
 * }
 */
final class Variant implements BaseModel
{
    /** @use SdkModel<VariantShape> */
    use SdkModel;

    /**
     * Explicit variant attributes such as color, size, material, pattern and properties declared by page.
     *
     * @var array<string,string> $attributes
     */
    #[Required(map: 'string')]
    public array $attributes;

    /**
     * Original source image URLs explicitly attached to this variant.
     *
     * @var list<string> $images
     */
    #[Required(list: 'string')]
    public array $images;

    #[Required]
    public ?string $sku;

    /**
     * Variant or offer URL when provided by the source. May be shared by variants.
     */
    #[Required]
    public ?string $url;

    /**
     * Normalized stock or ordering availability of this variant.
     *
     * @var value-of<Availability>|null $availability
     */
    #[Optional(
        enum: Availability::class,
        nullable: true,
    )]
    public ?string $availability;

    /**
     * Currency code for the variant price (e.g., USD, EUR) when stated with it.
     */
    #[Optional(nullable: true)]
    public ?string $currency;

    /**
     * Price of this variant when the source states one per variant.
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
     * Explicit variant attributes such as color, size, material, pattern and properties declared by page.
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
     * Original source image URLs explicitly attached to this variant.
     *
     * @param list<string> $images
     */
    public function withImages(array $images): self
    {
        $self = clone $this;
        $self['images'] = $images;

        return $self;
    }

    public function withSKU(?string $sku): self
    {
        $self = clone $this;
        $self['sku'] = $sku;

        return $self;
    }

    /**
     * Variant or offer URL when provided by the source. May be shared by variants.
     */
    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Normalized stock or ordering availability of this variant.
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
     * Currency code for the variant price (e.g., USD, EUR) when stated with it.
     */
    public function withCurrency(?string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Price of this variant when the source states one per variant.
     */
    public function withPrice(?float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }
}
