<?php

declare(strict_types=1);

namespace ContextDev\Scholar;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Scholar\ScholarSearchParams\FilterBy;
use ContextDev\Scholar\ScholarSearchParams\Sort;

/**
 * Search full-text papers from arXiv and Europe PMC. Returns up to 250 relevant papers with matching passages and full-text links.
 *
 * @see ContextDev\Services\ScholarService::search()
 *
 * @phpstan-import-type FilterByShape from \ContextDev\Scholar\ScholarSearchParams\FilterBy
 *
 * @phpstan-type ScholarSearchParamsShape = array{
 *   query: string,
 *   cursor?: string|null,
 *   filterBy?: null|FilterBy|FilterByShape,
 *   limit?: int|null,
 *   sort?: null|Sort|value-of<Sort>,
 *   tags?: list<string>|null,
 * }
 */
final class ScholarSearchParams implements BaseModel
{
    /** @use SdkModel<ScholarSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A topic or question. Append one arxiv:, pmcid:, pmid:, or doi: ID to search within an indexed paper.
     */
    #[Required]
    public string $query;

    /**
     * Use next_cursor to fetch the next page.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * Filter by publication date.
     */
    #[Optional]
    public ?FilterBy $filterBy;

    /**
     * Papers per page.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Order the top 250 matches. date_desc puts newest first, with undated papers last.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    /**
     * Labels for filtering usage in the dashboard.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new ScholarSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ScholarSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ScholarSearchParams)->withQuery(...)
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
     * @param FilterBy|FilterByShape|null $filterBy
     * @param Sort|value-of<Sort>|null $sort
     * @param list<string>|null $tags
     */
    public static function with(
        string $query,
        ?string $cursor = null,
        FilterBy|array|null $filterBy = null,
        ?int $limit = null,
        Sort|string|null $sort = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $filterBy && $self['filterBy'] = $filterBy;
        null !== $limit && $self['limit'] = $limit;
        null !== $sort && $self['sort'] = $sort;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * A topic or question. Append one arxiv:, pmcid:, pmid:, or doi: ID to search within an indexed paper.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Use next_cursor to fetch the next page.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Filter by publication date.
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
     * Papers per page.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Order the top 250 matches. date_desc puts newest first, with undated papers last.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $self = clone $this;
        $self['sort'] = $sort;

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
