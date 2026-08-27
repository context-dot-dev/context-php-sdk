<?php

declare(strict_types=1);

namespace ContextDev\AI;

use ContextDev\AI\AIExtractProductsResponse\CacheMetadata;
use ContextDev\AI\AIExtractProductsResponse\KeyMetadata;
use ContextDev\AI\AIExtractProductsResponse\Product;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\AI\AIExtractProductsResponse\CacheMetadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\AI\AIExtractProductsResponse\KeyMetadata
 * @phpstan-import-type ProductShape from \ContextDev\AI\AIExtractProductsResponse\Product
 *
 * @phpstan-type AIExtractProductsResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   products?: list<Product|ProductShape>|null,
 * }
 */
final class AIExtractProductsResponse implements BaseModel
{
    /** @use SdkModel<AIExtractProductsResponseShape> */
    use SdkModel;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

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

    /**
     * `new AIExtractProductsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AIExtractProductsResponse::with(cacheMetadata: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AIExtractProductsResponse)->withCacheMetadata(...)
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
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     * @param list<Product|ProductShape>|null $products
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        KeyMetadata|array|null $keyMetadata = null,
        ?array $products = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $products && $self['products'] = $products;

        return $self;
    }

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     *
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     */
    public function withCacheMetadata(CacheMetadata|array $cacheMetadata): self
    {
        $self = clone $this;
        $self['cacheMetadata'] = $cacheMetadata;

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
