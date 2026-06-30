<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListChangesResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListChangesResponse\Data\ChangeDetectionType;
use ContextDev\Monitors\MonitorListChangesResponse\Data\Importance;
use ContextDev\Monitors\MonitorListChangesResponse\Data\Mode;
use ContextDev\Monitors\MonitorListChangesResponse\Data\TargetType;

/**
 * A lightweight change summary. `mode` is the constant `web`; `target_type` and `change_detection_type` describe the change, and which optional fields are present depends on them (e.g. sitemap changes include `added_url_count`/`removed_url_count`; semantic changes include `confidence`/`importance`).
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   detectedAt: \DateTimeInterface,
 *   mode: Mode|value-of<Mode>,
 *   monitorID: string,
 *   summary: string,
 *   targetType: TargetType|value-of<TargetType>,
 *   title: string,
 *   url: string,
 *   addedURLCount?: int|null,
 *   confidence?: float|null,
 *   importance?: null|Importance|value-of<Importance>,
 *   matchedURLCount?: int|null,
 *   removedURLCount?: int|null,
 *   tags?: list<string>|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var value-of<ChangeDetectionType> $changeDetectionType */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    #[Required('detected_at')]
    public \DateTimeInterface $detectedAt;

    /**
     * Top-level monitor category. Always `web` today; the concrete behavior is described by `target` and `change_detection`.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    #[Required('monitor_id')]
    public string $monitorID;

    #[Required]
    public string $summary;

    /** @var value-of<TargetType> $targetType */
    #[Required('target_type', enum: TargetType::class)]
    public string $targetType;

    #[Required]
    public string $title;

    #[Required]
    public string $url;

    #[Optional('added_url_count')]
    public ?int $addedURLCount;

    #[Optional]
    public ?float $confidence;

    /** @var value-of<Importance>|null $importance */
    #[Optional(enum: Importance::class)]
    public ?string $importance;

    #[Optional('matched_url_count')]
    public ?int $matchedURLCount;

    #[Optional('removed_url_count')]
    public ?int $removedURLCount;

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   changeDetectionType: ...,
     *   detectedAt: ...,
     *   mode: ...,
     *   monitorID: ...,
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
     * (new Data)
     *   ->withID(...)
     *   ->withChangeDetectionType(...)
     *   ->withDetectedAt(...)
     *   ->withMode(...)
     *   ->withMonitorID(...)
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
     * @param Mode|value-of<Mode> $mode
     * @param TargetType|value-of<TargetType> $targetType
     * @param Importance|value-of<Importance>|null $importance
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        ChangeDetectionType|string $changeDetectionType,
        \DateTimeInterface $detectedAt,
        Mode|string $mode,
        string $monitorID,
        string $summary,
        TargetType|string $targetType,
        string $title,
        string $url,
        ?int $addedURLCount = null,
        ?float $confidence = null,
        Importance|string|null $importance = null,
        ?int $matchedURLCount = null,
        ?int $removedURLCount = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['detectedAt'] = $detectedAt;
        $self['mode'] = $mode;
        $self['monitorID'] = $monitorID;
        $self['summary'] = $summary;
        $self['targetType'] = $targetType;
        $self['title'] = $title;
        $self['url'] = $url;

        null !== $addedURLCount && $self['addedURLCount'] = $addedURLCount;
        null !== $confidence && $self['confidence'] = $confidence;
        null !== $importance && $self['importance'] = $importance;
        null !== $matchedURLCount && $self['matchedURLCount'] = $matchedURLCount;
        null !== $removedURLCount && $self['removedURLCount'] = $removedURLCount;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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

    /**
     * Top-level monitor category. Always `web` today; the concrete behavior is described by `target` and `change_detection`.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

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

    public function withAddedURLCount(int $addedURLCount): self
    {
        $self = clone $this;
        $self['addedURLCount'] = $addedURLCount;

        return $self;
    }

    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * @param Importance|value-of<Importance> $importance
     */
    public function withImportance(Importance|string $importance): self
    {
        $self = clone $this;
        $self['importance'] = $importance;

        return $self;
    }

    public function withMatchedURLCount(int $matchedURLCount): self
    {
        $self = clone $this;
        $self['matchedURLCount'] = $matchedURLCount;

        return $self;
    }

    public function withRemovedURLCount(int $removedURLCount): self
    {
        $self = clone $this;
        $self['removedURLCount'] = $removedURLCount;

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
