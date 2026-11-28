<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchListParams\SearchType;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Batch\BatchListParams\Tags;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * List your batches, newest first. Filter by status or tags, or search by batch ID, crawl source, or tag.
 *
 * @see ContextDev\Services\BatchService::list()
 *
 * @phpstan-import-type TagsVariants from \ContextDev\Batch\BatchListParams\Tags
 * @phpstan-import-type TagsShape from \ContextDev\Batch\BatchListParams\Tags
 *
 * @phpstan-type BatchListParamsShape = array{
 *   cursor?: string|null,
 *   limit?: int|null,
 *   q?: string|null,
 *   searchType?: null|SearchType|value-of<SearchType>,
 *   status?: null|Status|value-of<Status>,
 *   tags?: TagsShape|null,
 * }
 */
final class BatchListParams implements BaseModel
{
    /** @use SdkModel<BatchListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of batches to return per page.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Search term matched against batch IDs, crawl sources (start URL or sitemap domain), and tags.
     */
    #[Optional]
    public ?string $q;

    /**
     * How `q` matches: `prefix` matches the start of a term, for search-as-you-type, and `exact` matches whole terms. Defaults to `prefix`.
     *
     * @var value-of<SearchType>|null $searchType
     */
    #[Optional(enum: SearchType::class)]
    public ?string $searchType;

    /**
     * Filter by batch status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Comma-separated tags. Returns batches that have any of them. You can also repeat the `tags` parameter.
     *
     * @var TagsVariants|null $tags
     */
    #[Optional(union: Tags::class)]
    public string|array|null $tags;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param SearchType|value-of<SearchType>|null $searchType
     * @param Status|value-of<Status>|null $status
     * @param TagsShape|null $tags
     */
    public static function with(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $q = null,
        SearchType|string|null $searchType = null,
        Status|string|null $status = null,
        string|array|null $tags = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $q && $self['q'] = $q;
        null !== $searchType && $self['searchType'] = $searchType;
        null !== $status && $self['status'] = $status;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Maximum number of batches to return per page.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Search term matched against batch IDs, crawl sources (start URL or sitemap domain), and tags.
     */
    public function withQ(string $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }

    /**
     * How `q` matches: `prefix` matches the start of a term, for search-as-you-type, and `exact` matches whole terms. Defaults to `prefix`.
     *
     * @param SearchType|value-of<SearchType> $searchType
     */
    public function withSearchType(SearchType|string $searchType): self
    {
        $self = clone $this;
        $self['searchType'] = $searchType;

        return $self;
    }

    /**
     * Filter by batch status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Comma-separated tags. Returns batches that have any of them. You can also repeat the `tags` parameter.
     *
     * @param TagsShape $tags
     */
    public function withTags(string|array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
