<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeResponse\Product\Data\Product;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type VariantShape = array{
 *   attributes: array<string,string>,
 *   images: list<string>,
 *   sku: string|null,
 *   url: string|null,
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
     */
    public static function with(
        array $attributes,
        array $images,
        ?string $sku,
        ?string $url
    ): self {
        $self = new self;

        $self['attributes'] = $attributes;
        $self['images'] = $images;
        $self['sku'] = $sku;
        $self['url'] = $url;

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
}
