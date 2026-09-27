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
 *   requestID: string,
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
 * }
 */
final class WebWebCrawlMdResponse implements BaseModel
{
    /** @use SdkModel<WebWebCrawlMdResponseShape> */
    use SdkModel;

    /**
     * Whether this response came from cache.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    #[Required]
    public Metadata $metadata;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /** @var list<Result> $results */
    #[Required(list: Result::class)]
    public array $results;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * True when timeoutOpts.behavior=return-partial returned the usable results collected before the deadline. Partial collections are not cached as complete results.
     */
    #[Optional]
    public ?bool $partial;

    /**
     * `new WebWebCrawlMdResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebWebCrawlMdResponse::with(
     *   cacheMetadata: ..., metadata: ..., requestID: ..., results: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebWebCrawlMdResponse)
     *   ->withCacheMetadata(...)
     *   ->withMetadata(...)
     *   ->withRequestID(...)
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
        string $requestID,
        array $results,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;
        $self['metadata'] = $metadata;
        $self['requestID'] = $requestID;
        $self['results'] = $results;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $partial && $self['partial'] = $partial;

        return $self;
    }

    /**
     * Whether this response came from cache.
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
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

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
     * Credits this request used and your remaining balance.
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
     * True when timeoutOpts.behavior=return-partial returned the usable results collected before the deadline. Partial collections are not cached as complete results.
     */
    public function withPartial(bool $partial): self
    {
        $self = clone $this;
        $self['partial'] = $partial;

        return $self;
    }
}
