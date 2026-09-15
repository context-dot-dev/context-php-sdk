<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandGetSimplifiedResponse\Brand;
use ContextDev\Brand\BrandGetSimplifiedResponse\CacheMetadata;
use ContextDev\Brand\BrandGetSimplifiedResponse\KeyMetadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BrandShape from \ContextDev\Brand\BrandGetSimplifiedResponse\Brand
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Brand\BrandGetSimplifiedResponse\CacheMetadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Brand\BrandGetSimplifiedResponse\KeyMetadata
 *
 * @phpstan-type BrandGetSimplifiedResponseShape = array{
 *   brand: Brand|BrandShape,
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   code: int,
 *   requestID: string,
 *   status: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
 * }
 */
final class BrandGetSimplifiedResponse implements BaseModel
{
    /** @use SdkModel<BrandGetSimplifiedResponseShape> */
    use SdkModel;

    /**
     * Simplified brand information.
     */
    #[Required]
    public Brand $brand;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * HTTP status code of the response.
     */
    #[Required]
    public int $code;

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Required]
    public string $status;

    /**
     * Credit usage, included whenever a valid API key is provided.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * True when the timeout ended processing and only completed brand data is returned.
     */
    #[Optional]
    public ?bool $partial;

    /**
     * `new BrandGetSimplifiedResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandGetSimplifiedResponse::with(
     *   brand: ..., cacheMetadata: ..., code: ..., requestID: ..., status: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandGetSimplifiedResponse)
     *   ->withBrand(...)
     *   ->withCacheMetadata(...)
     *   ->withCode(...)
     *   ->withRequestID(...)
     *   ->withStatus(...)
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
     * @param Brand|BrandShape $brand
     * @param CacheMetadata|CacheMetadataShape $cacheMetadata
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        Brand|array $brand,
        CacheMetadata|array $cacheMetadata,
        int $code,
        string $requestID,
        string $status,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
    ): self {
        $self = new self;

        $self['brand'] = $brand;
        $self['cacheMetadata'] = $cacheMetadata;
        $self['code'] = $code;
        $self['requestID'] = $requestID;
        $self['status'] = $status;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $partial && $self['partial'] = $partial;

        return $self;
    }

    /**
     * Simplified brand information.
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
     * HTTP status code of the response.
     */
    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Unique id of this API call, also sent in the X-Request-Id response header. Quote it when contacting support about a failed request.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

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

    /**
     * Credit usage, included whenever a valid API key is provided.
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
     * True when the timeout ended processing and only completed brand data is returned.
     */
    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }
}
