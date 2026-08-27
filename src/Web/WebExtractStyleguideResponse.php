<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractStyleguideResponse\CacheMetadata;
use ContextDev\Web\WebExtractStyleguideResponse\KeyMetadata;
use ContextDev\Web\WebExtractStyleguideResponse\Styleguide;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebExtractStyleguideResponse\CacheMetadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebExtractStyleguideResponse\KeyMetadata
 * @phpstan-import-type StyleguideShape from \ContextDev\Web\WebExtractStyleguideResponse\Styleguide
 *
 * @phpstan-type WebExtractStyleguideResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   code?: int|null,
 *   domain?: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   status?: string|null,
 *   styleguide?: null|Styleguide|StyleguideShape,
 * }
 */
final class WebExtractStyleguideResponse implements BaseModel
{
    /** @use SdkModel<WebExtractStyleguideResponseShape> */
    use SdkModel;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * HTTP status code.
     */
    #[Optional]
    public ?int $code;

    /**
     * The normalized domain that was processed.
     */
    #[Optional]
    public ?string $domain;

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
     * Comprehensive styleguide data extracted from the website.
     */
    #[Optional]
    public ?Styleguide $styleguide;

    /**
     * `new WebExtractStyleguideResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebExtractStyleguideResponse::with(cacheMetadata: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebExtractStyleguideResponse)->withCacheMetadata(...)
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
     * @param Styleguide|StyleguideShape|null $styleguide
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        ?int $code = null,
        ?string $domain = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?string $status = null,
        Styleguide|array|null $styleguide = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;

        null !== $code && $self['code'] = $code;
        null !== $domain && $self['domain'] = $domain;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $status && $self['status'] = $status;
        null !== $styleguide && $self['styleguide'] = $styleguide;

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
     * HTTP status code.
     */
    public function withCode(int $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * The normalized domain that was processed.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

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

    /**
     * Comprehensive styleguide data extracted from the website.
     *
     * @param Styleguide|StyleguideShape $styleguide
     */
    public function withStyleguide(Styleguide|array $styleguide): self
    {
        $self = clone $this;
        $self['styleguide'] = $styleguide;

        return $self;
    }
}
