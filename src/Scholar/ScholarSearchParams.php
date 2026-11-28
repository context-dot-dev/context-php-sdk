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
 * Search the full text of papers from arXiv and Europe PMC by topic or question. Each result includes the matching passage and a direct link to the full text. Page through up to 250 matches, ranked by relevance or newest first.
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
     * Topic or question to search for. Append one `arxiv:`, `pmcid:`, `pmid:`, or `doi:` ID to search within that paper, such as `protein folding pmid:34265844`, or send the ID on its own.
     */
    #[Required]
    public string $query;

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * Filter by publication date.
     */
    #[Optional]
    public ?FilterBy $filterBy;

    /**
     * Maximum number of papers to return per page.
     */
    #[Optional]
    public ?int $limit;

    /**
     * `relevance` puts the closest matches first; `date_desc` puts the newest papers first, with undated papers last. Both orders apply to the top 250 matches.
     *
     * @var value-of<Sort>|null $sort
     */
    #[Optional(enum: Sort::class)]
    public ?string $sort;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
     * Topic or question to search for. Append one `arxiv:`, `pmcid:`, `pmid:`, or `doi:` ID to search within that paper, such as `protein folding pmid:34265844`, or send the ID on its own.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
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
     * Maximum number of papers to return per page.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * `relevance` puts the closest matches first; `date_desc` puts the newest papers first, with undated papers last. Both orders apply to the top 250 matches.
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
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
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
