<?php

declare(strict_types=1);

namespace ContextDev\Brand;

use ContextDev\Brand\BrandSearchParams\QueryBy;
use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Search indexed brands by name or domain.
 *
 * @see ContextDev\Services\BrandService::search()
 *
 * @phpstan-type BrandSearchParamsShape = array{
 *   query: string,
 *   autocomplete?: bool|null,
 *   queryBy?: list<QueryBy|value-of<QueryBy>>|null,
 *   tags?: list<string>|null,
 *   typoTolerance?: int|null,
 * }
 */
final class BrandSearchParams implements BaseModel
{
    /** @use SdkModel<BrandSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search term, matched against the fields selected by queryBy (e.g. 'nike', 'nike.com', 'nik').
     */
    #[Required]
    public string $query;

    /**
     * Whether the search term matches by prefix, so partial words match as they are typed (e.g. 'nik' matches Nike). Set to false to match whole words only.
     */
    #[Optional]
    public ?bool $autocomplete;

    /**
     * Fields to match the search term against, as a comma-separated list or repeated parameter: 'name', 'domain', or both. Defaults to both.
     *
     * @var list<value-of<QueryBy>>|null $queryBy
     */
    #[Optional(list: QueryBy::class)]
    public ?array $queryBy;

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Maximum number of typos tolerated when matching, from 0 to 2. Defaults to 0 (no typo tolerance).
     */
    #[Optional]
    public ?int $typoTolerance;

    /**
     * `new BrandSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandSearchParams)->withQuery(...)
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
     * @param list<QueryBy|value-of<QueryBy>>|null $queryBy
     * @param list<string>|null $tags
     */
    public static function with(
        string $query,
        ?bool $autocomplete = null,
        ?array $queryBy = null,
        ?array $tags = null,
        ?int $typoTolerance = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $autocomplete && $self['autocomplete'] = $autocomplete;
        null !== $queryBy && $self['queryBy'] = $queryBy;
        null !== $tags && $self['tags'] = $tags;
        null !== $typoTolerance && $self['typoTolerance'] = $typoTolerance;

        return $self;
    }

    /**
     * Search term, matched against the fields selected by queryBy (e.g. 'nike', 'nike.com', 'nik').
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Whether the search term matches by prefix, so partial words match as they are typed (e.g. 'nik' matches Nike). Set to false to match whole words only.
     */
    public function withAutocomplete(bool $autocomplete): self
    {
        $self = clone $this;
        $self['autocomplete'] = $autocomplete;

        return $self;
    }

    /**
     * Fields to match the search term against, as a comma-separated list or repeated parameter: 'name', 'domain', or both. Defaults to both.
     *
     * @param list<QueryBy|value-of<QueryBy>> $queryBy
     */
    public function withQueryBy(array $queryBy): self
    {
        $self = clone $this;
        $self['queryBy'] = $queryBy;

        return $self;
    }

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Maximum number of typos tolerated when matching, from 0 to 2. Defaults to 0 (no typo tolerance).
     */
    public function withTypoTolerance(int $typoTolerance): self
    {
        $self = clone $this;
        $self['typoTolerance'] = $typoTolerance;

        return $self;
    }
}
