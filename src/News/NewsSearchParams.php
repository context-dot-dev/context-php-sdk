<?php

declare(strict_types=1);

namespace ContextDev\News;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\News\NewsSearchParams\FilterBy;
use ContextDev\News\NewsSearchParams\SearchBy;
use ContextDev\News\NewsSearchParams\SortBy;

/**
 * Searches live and historical company news for one company, identified in searchBy by name, domain, ticker (optionally disambiguated by exchange), or ISIN. Results can be filtered by publisher domain, publisher country, article language, article type, and published-at date, and include stable story IDs, source metadata, verified entity relevance, and cursor pagination.
 *
 * @see ContextDev\Services\NewsService::search()
 *
 * @phpstan-import-type SearchByShape from \ContextDev\News\NewsSearchParams\SearchBy
 * @phpstan-import-type FilterByShape from \ContextDev\News\NewsSearchParams\FilterBy
 * @phpstan-import-type SortByShape from \ContextDev\News\NewsSearchParams\SortBy
 *
 * @phpstan-type NewsSearchParamsShape = array{
 *   searchBy: SearchBy|SearchByShape,
 *   cursor?: string|null,
 *   filterBy?: null|FilterBy|FilterByShape,
 *   limit?: int|null,
 *   sortBy?: null|SortBy|SortByShape,
 *   tags?: list<string>|null,
 * }
 */
final class NewsSearchParams implements BaseModel
{
    /** @use SdkModel<NewsSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * What to search for.
     */
    #[Required]
    public SearchBy $searchBy;

    /**
     * Opaque next_cursor from the previous response, or null for the first page.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * Optional result filters.
     */
    #[Optional]
    public ?FilterBy $filterBy;

    /**
     * Maximum results to return. Defaults to 10.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Result ordering. Defaults to newest.
     */
    #[Optional]
    public ?SortBy $sortBy;

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new NewsSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewsSearchParams::with(searchBy: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewsSearchParams)->withSearchBy(...)
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
     * @param SearchBy|SearchByShape $searchBy
     * @param FilterBy|FilterByShape|null $filterBy
     * @param SortBy|SortByShape|null $sortBy
     * @param list<string>|null $tags
     */
    public static function with(
        SearchBy|array $searchBy,
        ?string $cursor = null,
        FilterBy|array|null $filterBy = null,
        ?int $limit = null,
        SortBy|array|null $sortBy = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['searchBy'] = $searchBy;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $filterBy && $self['filterBy'] = $filterBy;
        null !== $limit && $self['limit'] = $limit;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * What to search for.
     *
     * @param SearchBy|SearchByShape $searchBy
     */
    public function withSearchBy(SearchBy|array $searchBy): self
    {
        $self = clone $this;
        $self['searchBy'] = $searchBy;

        return $self;
    }

    /**
     * Opaque next_cursor from the previous response, or null for the first page.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Optional result filters.
     *
     * @param FilterBy|FilterByShape $filterBy
     */
    public function withFilterBy(FilterBy|array $filterBy): self
    {
        $self = clone $this;
        $self['filterBy'] = $filterBy;

        return $self;
    }

    /**
     * Maximum results to return. Defaults to 10.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Result ordering. Defaults to newest.
     *
     * @param SortBy|SortByShape $sortBy
     */
    public function withSortBy(SortBy|array $sortBy): self
    {
        $self = clone $this;
        $self['sortBy'] = $sortBy;

        return $self;
    }

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
