<?php

declare(strict_types=1);

namespace ContextDev\AI;

use ContextDev\AI\AIExtractProductsResponse\KeyMetadata;
use ContextDev\AI\AIExtractProductsResponse\Product;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\AI\AIExtractProductsResponse\KeyMetadata
 * @phpstan-import-type ProductShape from \ContextDev\AI\AIExtractProductsResponse\Product
 *
 * @phpstan-type AIExtractProductsResponseShape = array{
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   products?: list<Product|ProductShape>|null,
 * }
 */
final class AIExtractProductsResponse implements BaseModel
{
    /** @use SdkModel<AIExtractProductsResponseShape> */
    use SdkModel;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Array of products extracted from the website.
     *
     * @var list<Product>|null $products
     */
    #[Optional(list: Product::class)]
    public ?array $products;

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
     * @param list<Product|ProductShape>|null $products
     */
    public static function with(
        KeyMetadata|array|null $keyMetadata = null,
        ?array $products = null
    ): self {
        $self = new self;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $products && $self['products'] = $products;

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
     * Array of products extracted from the website.
     *
     * @param list<Product|ProductShape> $products
     */
    public function withProducts(array $products): self
    {
        $self = clone $this;
        $self['products'] = $products;

        return $self;
    }
}
