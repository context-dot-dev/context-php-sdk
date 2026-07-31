<?php

declare(strict_types=1);

namespace ContextDev\Batch;

use ContextDev\Batch\BatchListParams\SearchType;
use ContextDev\Batch\BatchListParams\Status;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * List your batches from newest to oldest. Filter by status or continue with a cursor.
 *
 * @see ContextDev\Services\BatchService::list()
 *
 * @phpstan-type BatchListParamsShape = array{
 *   cursor?: string|null,
 *   limit?: int|null,
 *   q?: string|null,
 *   searchType?: null|SearchType|value-of<SearchType>,
 *   status?: null|Status|value-of<Status>,
 *   tags?: string|null,
 * }
 */
final class BatchListParams implements BaseModel
{
    /** @use SdkModel<BatchListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Cursor from the previous page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Batches per page. Defaults to 25.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Free-text search term, matched against the batch id, crawl source (start URL or sitemap domain), and tags.
     */
    #[Optional]
    public ?string $q;

    /**
     * `prefix` for as-you-type prefix matching (default), `exact` for full-token matching.
     *
     * @var value-of<SearchType>|null $searchType
     */
    #[Optional(enum: SearchType::class)]
    public ?string $searchType;

    /**
     * Filter by status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Comma-separated list of tags to filter by (matches batches having any of them).
     */
    #[Optional]
    public ?string $tags;

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
     */
    public static function with(
        ?string $cursor = null,
        ?int $limit = null,
        ?string $q = null,
        SearchType|string|null $searchType = null,
        Status|string|null $status = null,
        ?string $tags = null,
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
     * Cursor from the previous page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Batches per page. Defaults to 25.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Free-text search term, matched against the batch id, crawl source (start URL or sitemap domain), and tags.
     */
    public function withQ(string $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }

    /**
     * `prefix` for as-you-type prefix matching (default), `exact` for full-token matching.
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
     * Filter by status.
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
     * Comma-separated list of tags to filter by (matches batches having any of them).
     */
    public function withTags(string $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
