<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListChangesResponse\Data;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsPageSemanticChangeSummary\ChangeDetectionType;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsPageSemanticChangeSummary\Importance;
use ContextDev\Monitors\MonitorListChangesResponse\Data\MonitorsPageSemanticChangeSummary\TargetType;

/**
 * @phpstan-type MonitorsPageSemanticChangeSummaryShape = array{
 *   id: string,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   confidence: float,
 *   detectedAt: \DateTimeInterface,
 *   importance: Importance|value-of<Importance>,
 *   monitorID: string,
 *   summary: string,
 *   targetType: TargetType|value-of<TargetType>,
 *   title: string,
 *   url: string,
 *   tags?: list<string>|null,
 * }
 */
final class MonitorsPageSemanticChangeSummary implements BaseModel
{
    /** @use SdkModel<MonitorsPageSemanticChangeSummaryShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var value-of<ChangeDetectionType> $changeDetectionType */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    #[Required]
    public float $confidence;

    #[Required('detected_at')]
    public \DateTimeInterface $detectedAt;

    /** @var value-of<Importance> $importance */
    #[Required(enum: Importance::class)]
    public string $importance;

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

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new MonitorsPageSemanticChangeSummary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsPageSemanticChangeSummary::with(
     *   id: ...,
     *   changeDetectionType: ...,
     *   confidence: ...,
     *   detectedAt: ...,
     *   importance: ...,
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
     * (new MonitorsPageSemanticChangeSummary)
     *   ->withID(...)
     *   ->withChangeDetectionType(...)
     *   ->withConfidence(...)
     *   ->withDetectedAt(...)
     *   ->withImportance(...)
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
     * @param Importance|value-of<Importance> $importance
     * @param TargetType|value-of<TargetType> $targetType
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        ChangeDetectionType|string $changeDetectionType,
        float $confidence,
        \DateTimeInterface $detectedAt,
        Importance|string $importance,
        string $monitorID,
        string $summary,
        TargetType|string $targetType,
        string $title,
        string $url,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['confidence'] = $confidence;
        $self['detectedAt'] = $detectedAt;
        $self['importance'] = $importance;
        $self['monitorID'] = $monitorID;
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

    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    public function withDetectedAt(\DateTimeInterface $detectedAt): self
    {
        $self = clone $this;
        $self['detectedAt'] = $detectedAt;

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
