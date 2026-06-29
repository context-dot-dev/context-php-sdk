<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListChangesResponse\Data;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsSitemapExactChangeSummary\ChangeDetectionType;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsSitemapExactChangeSummary\TargetType;

/**
 * @phpstan-type MonitorsSitemapExactChangeSummaryShape = array{
 *   id: string,
 *   addedURLCount: int,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   detectedAt: \DateTimeInterface,
 *   monitorID: string,
 *   removedURLCount: int,
 *   summary: string,
 *   targetType: TargetType|value-of<TargetType>,
 *   title: string,
 *   url: string,
 *   tags?: list<string>|null,
 * }
 */
final class MonitorsSitemapExactChangeSummary implements BaseModel
{
    /** @use SdkModel<MonitorsSitemapExactChangeSummaryShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('added_url_count')]
    public int $addedURLCount;

    /** @var value-of<ChangeDetectionType> $changeDetectionType */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    #[Required('detected_at')]
    public \DateTimeInterface $detectedAt;

    #[Required('monitor_id')]
    public string $monitorID;

    #[Required('removed_url_count')]
    public int $removedURLCount;

    #[Required]
    public string $summary;

    /** @var value-of<TargetType> $targetType */
    #[Required('target_type', enum: TargetType::class)]
    public string $targetType;

    #[Required]
    public string $title;

    #[Required]
    public string $url;

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new MonitorsSitemapExactChangeSummary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsSitemapExactChangeSummary::with(
     *   id: ...,
     *   addedURLCount: ...,
     *   changeDetectionType: ...,
     *   detectedAt: ...,
     *   monitorID: ...,
     *   removedURLCount: ...,
     *   summary: ...,
     *   targetType: ...,
     *   title: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorsSitemapExactChangeSummary)
     *   ->withID(...)
     *   ->withAddedURLCount(...)
     *   ->withChangeDetectionType(...)
     *   ->withDetectedAt(...)
     *   ->withMonitorID(...)
     *   ->withRemovedURLCount(...)
     *   ->withSummary(...)
     *   ->withTargetType(...)
     *   ->withTitle(...)
     *   ->withURL(...)
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
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     * @param TargetType|value-of<TargetType> $targetType
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        int $addedURLCount,
        ChangeDetectionType|string $changeDetectionType,
        \DateTimeInterface $detectedAt,
        string $monitorID,
        int $removedURLCount,
        string $summary,
        TargetType|string $targetType,
        string $title,
        string $url,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['addedURLCount'] = $addedURLCount;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['detectedAt'] = $detectedAt;
        $self['monitorID'] = $monitorID;
        $self['removedURLCount'] = $removedURLCount;
        $self['summary'] = $summary;
        $self['targetType'] = $targetType;
        $self['title'] = $title;
        $self['url'] = $url;

        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAddedURLCount(int $addedURLCount): self
    {
        $self = clone $this;
        $self['addedURLCount'] = $addedURLCount;

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

    public function withDetectedAt(\DateTimeInterface $detectedAt): self
    {
        $self = clone $this;
        $self['detectedAt'] = $detectedAt;

        return $self;
    }

    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    public function withRemovedURLCount(int $removedURLCount): self
    {
        $self = clone $this;
        $self['removedURLCount'] = $removedURLCount;

        return $self;
    }

    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

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

    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
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
