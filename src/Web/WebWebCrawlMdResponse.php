<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebWebCrawlMdResponse\CacheMetadata;
use ContextDev\Web\WebWebCrawlMdResponse\KeyMetadata;
use ContextDev\Web\WebWebCrawlMdResponse\Metadata;
use ContextDev\Web\WebWebCrawlMdResponse\Result;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebWebCrawlMdResponse\CacheMetadata
 * @phpstan-import-type MetadataShape from \ContextDev\Web\WebWebCrawlMdResponse\Metadata
 * @phpstan-import-type ResultShape from \ContextDev\Web\WebWebCrawlMdResponse\Result
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebWebCrawlMdResponse\KeyMetadata
 *
 * @phpstan-type WebWebCrawlMdResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   metadata: Metadata|MetadataShape,
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class WebWebCrawlMdResponse implements BaseModel
{
    /** @use SdkModel<WebWebCrawlMdResponseShape> */
    use SdkModel;

    /**
     * Cache outcome for this response. Composite responses are hits only when every cache-controlled fetch contributing to the output was a hit; age_ms is the oldest contributing hit.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    #[Required]
    public Metadata $metadata;

    /** @var list<Result> $results */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new WebWebCrawlMdResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebCrawlMdResponse::with(cacheMetadata: ..., metadata: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebCrawlMdResponse)
     *   ->withCacheMetadata(...)
     *   ->withMetadata(...)
     *   ->withResults(...)
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
     * @param Metadata|MetadataShape $metadata
     * @param list<Result|ResultShape> $results
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        Metadata|array $metadata,
        array $results,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;
        $self['metadata'] = $metadata;
        $self['results'] = $results;

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
     * @param Metadata|MetadataShape $metadata
     */
    public function withMetadata(Metadata|array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

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
