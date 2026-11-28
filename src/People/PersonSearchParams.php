<?php

declare(strict_types=1);

namespace ContextDev\People;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\People\PersonSearchParams\Filters;
use ContextDev\People\PersonSearchParams\Mode;
use ContextDev\People\PersonSearchParams\Zdr;

/**
 * Find people from a plain-language description, such as `VPs of sales at solar companies in California`. Each result includes the current role and employer, location, years of experience, skills, schools, and public profile URLs. Pages with no matches are free.
 *
 * @see ContextDev\Services\PeopleService::search()
 *
 * @phpstan-import-type FiltersShape from \ContextDev\People\PersonSearchParams\Filters
 *
 * @phpstan-type PersonSearchParamsShape = array{
 *   query: string,
 *   cursor?: string|null,
 *   filters?: null|Filters|FiltersShape,
 *   mode?: null|Mode|value-of<Mode>,
 *   tags?: list<string>|null,
 *   zdr?: null|Zdr|value-of<Zdr>,
 * }
 */
final class PersonSearchParams implements BaseModel
{
    /** @use SdkModel<PersonSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Plain-language description of the people to find. Up to 500 characters in `fast` mode and 5000 in `ultra` mode.
     */
    #[Required]
    public string $query;

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page. Send the same `query`, `mode`, and `filters` with it.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Constraints every result must match, in addition to `query`.
     */
    #[Optional]
    public ?Filters $filters;

    /**
     * `fast` matches people on basic criteria such as role, location, or background; `ultra` runs a deeper search, checks every candidate against each criterion in your query, and adds a `match` score. Complex `ultra` searches can take up to 30 seconds, so set your client timeout to match.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Labels for this request. Filter usage and request logs by them in the dashboard or with `GET /org/logs`.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @var value-of<Zdr>|null $zdr
     */
    #[Optional(enum: Zdr::class)]
    public ?string $zdr;

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
     * @param Mode|value-of<Mode>|null $mode
     * @param list<string>|null $tags
     * @param Zdr|value-of<Zdr>|null $zdr
     */
    public static function with(
        string $query,
        ?string $cursor = null,
        Filters|array|null $filters = null,
        Mode|string|null $mode = null,
        ?array $tags = null,
        Zdr|string|null $zdr = null,
    ): self {
        $self = new self;

        $self['query'] = $query;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $filters && $self['filters'] = $filters;
        null !== $mode && $self['mode'] = $mode;
        null !== $tags && $self['tags'] = $tags;
        null !== $zdr && $self['zdr'] = $zdr;

        return $self;
    }

    /**
     * Plain-language description of the people to find. Up to 500 characters in `fast` mode and 5000 in `ultra` mode.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page. Send the same `query`, `mode`, and `filters` with it.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Constraints every result must match, in addition to `query`.
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
     * `fast` matches people on basic criteria such as role, location, or background; `ultra` runs a deeper search, checks every candidate against each criterion in your query, and adds a `match` score. Complex `ultra` searches can take up to 30 seconds, so set your client timeout to match.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

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

    /**
     * `enabled` turns on zero data retention. Returns 403 `ZDR_NOT_ENABLED` unless your organization has ZDR.
     *
     * @param Zdr|value-of<Zdr> $zdr
     */
    public function withZdr(Zdr|string $zdr): self
    {
        $self = clone $this;
        $self['zdr'] = $zdr;

        return $self;
    }
}
