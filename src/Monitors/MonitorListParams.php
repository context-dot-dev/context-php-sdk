<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListParams\ChangeDetectionType;
use ContextDev\Monitors\MonitorListParams\Status;
use ContextDev\Monitors\MonitorListParams\TargetType;

/**
 * List monitors.
 *
 * @see ContextDev\Services\MonitorsService::list()
 *
 * @phpstan-type MonitorListParamsShape = array{
 *   changeDetectionType?: null|ChangeDetectionType|value-of<ChangeDetectionType>,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   status?: null|Status|value-of<Status>,
 *   tag?: string|null,
 *   targetType?: null|TargetType|value-of<TargetType>,
 * }
 */
final class MonitorListParams implements BaseModel
{
    /** @use SdkModel<MonitorListParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var value-of<ChangeDetectionType>|null $changeDetectionType */
    #[Optional(enum: ChangeDetectionType::class)]
    public ?string $changeDetectionType;

    #[Optional]
    public ?string $cursor;

    #[Optional]
    public ?int $limit;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Filter to items that have this tag.
     */
    #[Optional]
    public ?string $tag;

    /** @var value-of<TargetType>|null $targetType */
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
     * @param Status|value-of<Status>|null $status
     * @param TargetType|value-of<TargetType>|null $targetType
     */
    public static function with(
        ChangeDetectionType|string|null $changeDetectionType = null,
        ?string $cursor = null,
        ?int $limit = null,
        Status|string|null $status = null,
        ?string $tag = null,
        TargetType|string|null $targetType = null,
    ): self {
        $self = new self;

        null !== $changeDetectionType && $self['changeDetectionType'] = $changeDetectionType;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;
        null !== $tag && $self['tag'] = $tag;
        null !== $targetType && $self['targetType'] = $targetType;

        return $self;
    }

    /**
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     */
    public function withChangeDetectionType(
        ChangeDetectionType|string $changeDetectionType
    ): self {
        $self = clone $this;
        $self['changeDetectionType'] = $changeDetectionType;

        return $self;
    }

    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Filter to items that have this tag.
     */
    public function withTag(string $tag): self
    {
        $self = clone $this;
        $self['tag'] = $tag;

        return $self;
    }

    /**
     * @param TargetType|value-of<TargetType> $targetType
     */
    public function withTargetType(TargetType|string $targetType): self
    {
        $self = clone $this;
        $self['targetType'] = $targetType;

        return $self;
    }
}
