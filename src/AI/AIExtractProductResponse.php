<?php

declare(strict_types=1);

namespace ContextDev\AI;

use ContextDev\AI\AIExtractProductResponse\KeyMetadata;
use ContextDev\AI\AIExtractProductResponse\Platform;
use ContextDev\AI\AIExtractProductResponse\Product;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\AI\AIExtractProductResponse\KeyMetadata
 * @phpstan-import-type ProductShape from \ContextDev\AI\AIExtractProductResponse\Product
 *
 * @phpstan-type AIExtractProductResponseShape = array{
 *   isProductPage?: bool|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   platform?: null|Platform|value-of<Platform>,
 *   product?: null|Product|ProductShape,
 * }
 */
final class AIExtractProductResponse implements BaseModel
{
    /** @use SdkModel<AIExtractProductResponseShape> */
    use SdkModel;

    /**
     * Whether the given URL is a product detail page.
     */
    #[Optional('is_product_page')]
    public ?bool $isProductPage;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * The detected ecommerce platform, or null if not a product page.
     *
     * @var value-of<Platform>|null $platform
     */
    #[Optional(enum: Platform::class, nullable: true)]
    public ?string $platform;

    /**
     * The extracted product data, or null if not a product page.
     */
    #[Optional(nullable: true)]
    public ?Product $product;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     * @param Platform|value-of<Platform>|null $platform
     * @param Product|ProductShape|null $product
     */
    public static function with(
        ?bool $isProductPage = null,
        KeyMetadata|array|null $keyMetadata = null,
        Platform|string|null $platform = null,
        Product|array|null $product = null,
    ): self {
        $self = new self;

        null !== $isProductPage && $self['isProductPage'] = $isProductPage;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $platform && $self['platform'] = $platform;
        null !== $product && $self['product'] = $product;

        return $self;
    }

    /**
     * Whether the given URL is a product detail page.
     */
    public function withIsProductPage(bool $isProductPage): self
    {
        $self = clone $this;
        $self['isProductPage'] = $isProductPage;

        return $self;
    }

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * The detected ecommerce platform, or null if not a product page.
     *
     * @param Platform|value-of<Platform>|null $platform
     */
    public function withPlatform(Platform|string|null $platform): self
    {
        $self = clone $this;
        $self['platform'] = $platform;

        return $self;
    }

    /**
     * The extracted product data, or null if not a product page.
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
