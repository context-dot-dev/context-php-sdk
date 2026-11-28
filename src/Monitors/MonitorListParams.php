<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListParams\ChangeDetectionType;
use ContextDev\Monitors\MonitorListParams\SearchBy;
use ContextDev\Monitors\MonitorListParams\SearchType;
use ContextDev\Monitors\MonitorListParams\Status;
use ContextDev\Monitors\MonitorListParams\TargetType;

/**
 * List your monitors, newest first. Search by name, URL, or instructions, and filter by status, target type, detection type, or tags.
 *
 * @see ContextDev\Services\MonitorsService::list()
 *
 * @phpstan-type MonitorListParamsShape = array{
 *   changeDetectionType?: null|ChangeDetectionType|value-of<ChangeDetectionType>,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   q?: string|null,
 *   searchBy?: list<SearchBy|value-of<SearchBy>>|null,
 *   searchType?: null|SearchType|value-of<SearchType>,
 *   status?: null|Status|value-of<Status>,
 *   tags?: list<string>|null,
 *   targetType?: null|TargetType|value-of<TargetType>,
 * }
 */
final class MonitorListParams implements BaseModel
{
    /** @use SdkModel<MonitorListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by change detection type.
     *
     * @var value-of<ChangeDetectionType>|null $changeDetectionType
     */
    #[Optional(enum: ChangeDetectionType::class)]
    public ?string $changeDetectionType;

    /**
     * Cursor from the previous page's `next_cursor`. Omit for the first page.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Maximum number of monitors to return per page. Defaults to 25.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Text to search for in the fields listed in `search_by`.
     */
    #[Optional]
    public ?string $q;

    /**
     * Comma-separated fields to search with `q`. Defaults to all fields. For search targets, `url` matches the target's `query`.
     *
     * @var list<value-of<SearchBy>>|null $searchBy
     */
    #[Optional(list: SearchBy::class, nullable: true)]
    public ?array $searchBy;

    /**
     * How `q` matches. `prefix` matches the start of words and tolerates one typo, for search as you type; `exact` matches whole words only. Defaults to `prefix`.
     *
     * @var value-of<SearchType>|null $searchType
     */
    #[Optional(enum: SearchType::class)]
    public ?string $searchType;

    /**
     * Filter by monitor status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Comma-separated tags. Returns monitors that have any of them.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    /**
     * Filter by target type.
     *
     * @var value-of<TargetType>|null $targetType
     */
    #[Optional(enum: TargetType::class)]
    public ?string $targetType;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ChangeDetectionType|value-of<ChangeDetectionType>|null $changeDetectionType
     * @param list<SearchBy|value-of<SearchBy>>|null $searchBy
     * @param SearchType|value-of<SearchType>|null $searchType
     * @param Status|value-of<Status>|null $status
     * @param list<string>|null $tags
     * @param TargetType|value-of<TargetType>|null $targetType
     */
    public static function with(
        ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $q = null,
        ?array $searchBy = null,
        SearchType|string|null $searchType = null,
        Status|string|null $status = null,
        ?array $tags = null,
        TargetType|string|null $targetType = null,
    ): self {
        $self = new self;

        null !== $changeDetectionType && $self['changeDetectionType'] = $changeDetectionType;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $q && $self['q'] = $q;
        null !== $searchBy && $self['searchBy'] = $searchBy;
        null !== $searchType && $self['searchType'] = $searchType;
        null !== $status && $self['status'] = $status;
        null !== $tags && $self['tags'] = $tags;
        null !== $targetType && $self['targetType'] = $targetType;

        return $self;
    }

    /**
     * Filter by change detection type.
     *
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     */
    public function withChangeDetectionType(
        ChangeDetectionType|string $changeDetectionType
    ): self {
        $self = clone $this;
        $self['changeDetectionType'] = $changeDetectionType;

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
     * Maximum number of monitors to return per page. Defaults to 25.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Text to search for in the fields listed in `search_by`.
     */
    public function withQ(string $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }

    /**
     * Comma-separated fields to search with `q`. Defaults to all fields. For search targets, `url` matches the target's `query`.
     *
     * @param list<SearchBy|value-of<SearchBy>>|null $searchBy
     */
    public function withSearchBy(?array $searchBy): self
    {
        $self = clone $this;
        $self['searchBy'] = $searchBy;

        return $self;
    }

    /**
     * How `q` matches. `prefix` matches the start of words and tolerates one typo, for search as you type; `exact` matches whole words only. Defaults to `prefix`.
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
     * Filter by monitor status.
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
     * Comma-separated tags. Returns monitors that have any of them.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Filter by target type.
     *
     * @param TargetType|value-of<TargetType> $targetType
     */
    public function withTargetType(TargetType|string $targetType): self
    {
        $self = clone $this;
        $self['targetType'] = $targetType;

        return $self;
    }
}
