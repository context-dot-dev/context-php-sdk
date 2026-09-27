<?php

declare(strict_types=1);

namespace ContextDev\Web;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebSearchResponse\CacheMetadata;
use ContextDev\Web\WebSearchResponse\KeyMetadata;
use ContextDev\Web\WebSearchResponse\Result;

/**
 * @phpstan-import-type CacheMetadataShape from \ContextDev\Web\WebSearchResponse\CacheMetadata
 * @phpstan-import-type ResultShape from \ContextDev\Web\WebSearchResponse\Result
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Web\WebSearchResponse\KeyMetadata
 *
 * @phpstan-type WebSearchResponseShape = array{
 *   cacheMetadata: CacheMetadata|CacheMetadataShape,
 *   query: string,
 *   requestID: string,
 *   results: list<Result|ResultShape>,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   partial?: bool|null,
 * }
 */
final class WebSearchResponse implements BaseModel
{
    /** @use SdkModel<WebSearchResponseShape> */
    use SdkModel;

    /**
     * Whether this response came from cache.
     */
    #[Required('cache_metadata')]
    public CacheMetadata $cacheMetadata;

    /**
     * Echo of the original query (useful when fanout was enabled).
     */
    #[Required]
    public string $query;

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
     * `new WebSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebSearchResponse::with(
     *   cacheMetadata: ..., query: ..., requestID: ..., results: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebSearchResponse)
     *   ->withCacheMetadata(...)
     *   ->withQuery(...)
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
     * @param list<Result|ResultShape> $results
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        CacheMetadata|array $cacheMetadata,
        string $query,
        string $requestID,
        array $results,
        KeyMetadata|array|null $keyMetadata = null,
        ?bool $partial = null,
    ): self {
        $self = new self;

        $self['cacheMetadata'] = $cacheMetadata;
        $self['query'] = $query;
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
     * Echo of the original query (useful when fanout was enabled).
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

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
