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
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByEntity;
use ContextDev\News\NewsSearchParams\SearchBy\NewsSearchByNaturalLanguage;
use ContextDev\News\NewsSearchParams\SortBy;

/**
 * Find news about a company by name, domain, ticker, or ISIN, or search all news with a natural-language query. Filter articles and continue through results with a cursor.
 *
 * @see ContextDev\Services\NewsService::search()
 *
 * @phpstan-import-type SearchByVariants from \ContextDev\News\NewsSearchParams\SearchBy
 * @phpstan-import-type SearchByShape from \ContextDev\News\NewsSearchParams\SearchBy
 * @phpstan-import-type FilterByShape from \ContextDev\News\NewsSearchParams\FilterBy
 * @phpstan-import-type SortByShape from \ContextDev\News\NewsSearchParams\SortBy
 *
 * @phpstan-type NewsSearchParamsShape = array{
 *   searchBy: SearchByShape,
 *   cursor?: string|null,
 *   filterBy?: null|FilterBy|FilterByShape,
 *   limit?: int|null,
 *   policies?: list<string>|null,
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
     * What to search for: a specific company, or a natural-language query across all news.
     *
     * @var SearchByVariants $searchBy
     */
    #[Required(union: SearchBy::class)]
    public NewsSearchByNaturalLanguage|NewsSearchByEntity $searchBy;

    /**
     * Opaque next_cursor from the previous response, or null for the first page.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * Optional result filters. Use at most one of sourceDomain, sourceCountry, articleLanguage, or articleType. A date range may accompany that category; date.from must not exceed date.to.
     */
    #[Optional]
    public ?FilterBy $filterBy;

    /**
     * Maximum results to return. Defaults to 10.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Access policy IDs to apply. A URL must pass every policy.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Result ordering. Defaults to newest for entity searches. Natural-language searches are always ordered by relevance.
     */
    #[Optional]
    public ?SortBy $sortBy;

    /**
     * Labels for filtering usage in the dashboard.
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
     * @param SearchByShape $searchBy
     * @param FilterBy|FilterByShape|null $filterBy
     * @param list<string>|null $policies
     * @param SortBy|SortByShape|null $sortBy
     * @param list<string>|null $tags
     */
    public static function with(
        NewsSearchByNaturalLanguage|array|NewsSearchByEntity $searchBy,
        ?string $cursor = null,
        FilterBy|array|null $filterBy = null,
        ?int $limit = null,
        ?array $policies = null,
        SortBy|array|null $sortBy = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['searchBy'] = $searchBy;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $filterBy && $self['filterBy'] = $filterBy;
        null !== $limit && $self['limit'] = $limit;
        null !== $policies && $self['policies'] = $policies;
        null !== $sortBy && $self['sortBy'] = $sortBy;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * What to search for: a specific company, or a natural-language query across all news.
     *
     * @param SearchByShape $searchBy
     */
    public function withSearchBy(
        NewsSearchByNaturalLanguage|array|NewsSearchByEntity $searchBy
    ): self {
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
     * Optional result filters. Use at most one of sourceDomain, sourceCountry, articleLanguage, or articleType. A date range may accompany that category; date.from must not exceed date.to.
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
     * Access policy IDs to apply. A URL must pass every policy.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }

    /**
     * Result ordering. Defaults to newest for entity searches. Natural-language searches are always ordered by relevance.
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
     * Labels for filtering usage in the dashboard.
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
