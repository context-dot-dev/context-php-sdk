<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListAccountChangesParams\ChangeDetectionType;
use ContextDev\Monitors\MonitorListAccountChangesParams\TargetType;

/**
 * List detected changes across all your monitors, newest first. Filter by monitor, target type, detection type, tag, or time range.
 *
 * @see ContextDev\Services\MonitorsService::listAccountChanges()
 *
 * @phpstan-type MonitorListAccountChangesParamsShape = array{
 *   changeDetectionType?: null|ChangeDetectionType|value-of<ChangeDetectionType>,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   monitorID?: string|null,
 *   since?: \DateTimeInterface|null,
 *   tag?: string|null,
 *   targetType?: null|TargetType|value-of<TargetType>,
 *   until?: \DateTimeInterface|null,
 * }
 */
final class MonitorListAccountChangesParams implements BaseModel
{
    /** @use SdkModel<MonitorListAccountChangesParamsShape> */
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
     * Maximum number of changes to return per page. Defaults to 25.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Return only changes from this monitor.
     */
    #[Optional]
    public ?string $monitorID;

    /**
     * Return only changes detected at or after this time.
     */
    #[Optional]
    public ?\DateTimeInterface $since;

    /**
     * Return only changes that have this tag.
     */
    #[Optional]
    public ?string $tag;

    /**
     * Filter by target type.
     *
     * @var value-of<TargetType>|null $targetType
     */
    #[Optional(enum: TargetType::class)]
    public ?string $targetType;

    /**
     * Return only changes detected at or before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $until;

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
     * @param TargetType|value-of<TargetType>|null $targetType
     */
    public static function with(
        ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $monitorID = null,
        ?\DateTimeInterface $since = null,
        ?string $tag = null,
        TargetType|string|null $targetType = null,
        ?\DateTimeInterface $until = null,
    ): self {
        $self = new self;

        null !== $changeDetectionType && $self['changeDetectionType'] = $changeDetectionType;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $monitorID && $self['monitorID'] = $monitorID;
        null !== $since && $self['since'] = $since;
        null !== $tag && $self['tag'] = $tag;
        null !== $targetType && $self['targetType'] = $targetType;
        null !== $until && $self['until'] = $until;

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
     * Maximum number of changes to return per page. Defaults to 25.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Return only changes from this monitor.
     */
    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    /**
     * Return only changes detected at or after this time.
     */
    public function withSince(\DateTimeInterface $since): self
    {
        $self = clone $this;
        $self['since'] = $since;

        return $self;
    }

    /**
     * Return only changes that have this tag.
     */
    public function withTag(string $tag): self
    {
        $self = clone $this;
        $self['tag'] = $tag;

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

    /**
     * Return only changes detected at or before this time.
     */
    public function withUntil(\DateTimeInterface $until): self
    {
        $self = clone $this;
        $self['until'] = $until;

        return $self;
    }
}
