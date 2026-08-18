<?php

declare(strict_types=1);

namespace ContextDev\News;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchResponse\Data;
use ContextDev\News\NewsSearchResponse\KeyMetadata;
use ContextDev\News\NewsSearchResponse\Meta;

/**
 * @phpstan-import-type DataShape from \ContextDev\News\NewsSearchResponse\Data
 * @phpstan-import-type MetaShape from \ContextDev\News\NewsSearchResponse\Meta
 * @phpstan-import-type KeyMetadataShape from \ContextDev\News\NewsSearchResponse\KeyMetadata
 *
 * @phpstan-type NewsSearchResponseShape = array{
 *   data: list<Data|DataShape>,
 *   hasMore: bool,
 *   meta: Meta|MetaShape,
 *   nextCursor: string|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class NewsSearchResponse implements BaseModel
{
    /** @use SdkModel<NewsSearchResponseShape> */
    use SdkModel;

    /**
     * Articles matching the search, in the requested order.
     *
     * @var list<Data> $data
     */
    #[Required(list: Data::class)]
    public array $data;

    /**
     * True when more results are available beyond this page.
     */
    #[Required('has_more')]
    public bool $hasMore;

    /**
     * Summary information about this response.
     */
    #[Required]
    public Meta $meta;

    /**
     * Pass as cursor in the next request to fetch the following page. Null when there are no more results.
     */
    #[Required('next_cursor')]
    public ?string $nextCursor;

    /**
     * Metadata about the API key used for the request. Included in every response whenever a valid API key is provided, even when the response status is not 200.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new NewsSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchResponse::with(data: ..., hasMore: ..., meta: ..., nextCursor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchResponse)
     *   ->withData(...)
     *   ->withHasMore(...)
     *   ->withMeta(...)
     *   ->withNextCursor(...)
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
     * @param list<Data|DataShape> $data
     * @param Meta|MetaShape $meta
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        array $data,
        bool $hasMore,
        Meta|array $meta,
        ?string $nextCursor,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['hasMore'] = $hasMore;
        $self['meta'] = $meta;
        $self['nextCursor'] = $nextCursor;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Articles matching the search, in the requested order.
     *
     * @param list<Data|DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * True when more results are available beyond this page.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * Summary information about this response.
     *
     * @param Meta|MetaShape $meta
     */
    public function withMeta(Meta|array $meta): self
    {
        $self = clone $this;
        $self['meta'] = $meta;

        return $self;
    }

    /**
     * Pass as cursor in the next request to fetch the following page. Null when there are no more results.
     */
    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

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
