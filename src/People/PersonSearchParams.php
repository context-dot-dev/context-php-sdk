<?php

declare(strict_types=1);

namespace ContextDev\People;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonSearchParams\Filters;

/**
 * Find people with a natural-language query.
 *
 * @see ContextDev\Services\PeopleService::search()
 *
 * @phpstan-import-type FiltersShape from \ContextDev\People\PersonSearchParams\Filters
 *
 * @phpstan-type PersonSearchParamsShape = array{
 *   query: string,
 *   cursor?: string|null,
 *   filters?: null|Filters|FiltersShape,
 *   tags?: list<string>|null,
 * }
 */
final class PersonSearchParams implements BaseModel
{
    /** @use SdkModel<PersonSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Describe the people to find.
     */
    #[Required]
    public string $query;

    /**
     * Use next_cursor with the same query and filters to fetch the next page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Additional constraints every result must match.
     */
    #[Optional]
    public ?Filters $filters;

    /**
     * Labels for filtering usage in the dashboard.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new PersonSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PersonSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PersonSearchParams)->withQuery(...)
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
     * @param Filters|FiltersShape|null $filters
     * @param list<string>|null $tags
     */
    public static function with(
        string $query,
        ?string $cursor = null,
        Filters|array|null $filters = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $filters && $self['filters'] = $filters;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    /**
     * Describe the people to find.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Use next_cursor with the same query and filters to fetch the next page.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Additional constraints every result must match.
     *
     * @param Filters|FiltersShape $filters
     */
    public function withFilters(Filters|array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

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
