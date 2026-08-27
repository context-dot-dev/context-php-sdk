<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebExtractResponse\CacheMetadata;
use ContextDev\Web\WebExtractResponse\KeyMetadata;
use ContextDev\Web\WebExtractResponse\Metadata;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebExtractResponse\CacheMetadata
 * @phpstan-import-type MetadataShape from \ContextDev\Web\WebExtractResponse\Metadata
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebExtractResponse\KeyMetadata
 *
 * @phpstan-type WebExtractResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   data: array<string,mixed>,
 *   metadata: Metadata|MetadataShape,
 *   status: string,
 *   url: string,
 *   urlsAnalyzed: list<string>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebExtractResponse implements BaseModel
{
    /** @use SdkModel<WebExtractResponseShape> */
    use SdkModel;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Extracted data matching the request schema.
     *
     * @var array<string,mixed> $data
     */
    #[Required(map: 'mixed')]
    public array $data;

    #[Required]
    public Metadata $metadata;

    /**
     * Status of the response, e.g., 'ok'.
     */
    #[Required]
    public string $status;

    /**
     * The starting URL that was analyzed.
     */
    #[Required]
    public string $url;

    /**
     * List of URLs whose Markdown was used for extraction.
     *
     * @var list<string> $urlsAnalyzed
     */
    #[Required('urls_analyzed', list: 'string')]
    public array $urlsAnalyzed;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebExtractResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebExtractResponse::with(
     *   cacheMetadata: ...,
     *   data: ...,
     *   metadata: ...,
     *   status: ...,
     *   url: ...,
     *   urlsAnalyzed: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebExtractResponse)
     *   ->withCacheMetadata(...)
     *   ->withData(...)
     *   ->withMetadata(...)
     *   ->withStatus(...)
     *   ->withURL(...)
     *   ->withURLsAnalyzed(...)
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
     * @param array<string,mixed> $data
     * @param Metadata|MetadataShape $metadata
     * @param list<string> $urlsAnalyzed
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        array $data,
        Metadata|array $metadata,
        string $status,
        string $url,
        array $urlsAnalyzed,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;
        $self['data'] = $data;
        $self['metadata'] = $metadata;
        $self['status'] = $status;
        $self['url'] = $url;
        $self['urlsAnalyzed'] = $urlsAnalyzed;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
     * Extracted data matching the request schema.
     *
     * @param array<string,mixed> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

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
     * The starting URL that was analyzed.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * List of URLs whose Markdown was used for extraction.
     *
     * @param list<string> $urlsAnalyzed
     */
    public function withURLsAnalyzed(array $urlsAnalyzed): self
    {
        $self = clone $this;
        $self['urlsAnalyzed'] = $urlsAnalyzed;

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
}
