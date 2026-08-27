<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandGetResponse\Brand;
use ContextDev\Brand\BrandGetResponse\CacheMetadata;
use ContextDev\Brand\BrandGetResponse\KeyMetadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Brand\BrandGetResponse\CacheMetadata
 * @phpstan-import-type BrandShape from \ContextDev\Brand\BrandGetResponse\Brand
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Brand\BrandGetResponse\KeyMetadata
 *
 * @phpstan-type BrandGetResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   brand?: null|Brand|BrandShape,
 *   code?: int|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   status?: string|null,
 * }
 */
final class BrandGetResponse implements BaseModel
{
    /** @use SdkModel<BrandGetResponseShape> */
    use SdkModel;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Detailed brand information.
     */
    #[Optional]
    public ?Brand $brand;

    /**
     * HTTP status code.
     */
    #[Optional]
    public ?int $code;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Optional]
    public ?string $status;

    /**
     * `new BrandGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandGetResponse::with(cacheMetadata: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandGetResponse)->withCacheMetadata(...)
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
     * @param Brand|BrandShape|null $brand
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        Brand|array|null $brand = null,
        ?int $code = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $status = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;

        null !== $brand && $self['brand'] = $brand;
        null !== $code && $self['code'] = $code;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $status && $self['status'] = $status;

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
     * Detailed brand information.
     *
     * @param Brand|BrandShape $brand
     */
    public function withBrand(Brand|array $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * HTTP status code.
     */
    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

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
     * Status of the response, e.g., 'ok'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
