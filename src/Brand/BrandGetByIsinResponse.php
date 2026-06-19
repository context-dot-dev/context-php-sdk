<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandGetByIsinResponse\Brand;
use ContextDev\Brand\BrandGetByIsinResponse\KeyMetadata;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BrandShape from \ContextDev\Brand\BrandGetByIsinResponse\Brand
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Brand\BrandGetByIsinResponse\KeyMetadata
 *
 * @phpstan-type BrandGetByIsinResponseShape = array{
 *   brand?: null|Brand|BrandShape,
 *   code?: int|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   status?: string|null,
 * }
 */
final class BrandGetByIsinResponse implements BaseModel
{
    /** @use SdkModel<BrandGetByIsinResponseShape> */
    use SdkModel;

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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Brand|BrandShape|null $brand
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        Brand|array|null $brand = null,
        ?int $code = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $brand && $self['brand'] = $brand;
        null !== $code && $self['code'] = $code;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $status && $self['status'] = $status;

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
