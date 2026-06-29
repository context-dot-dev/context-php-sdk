<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageExactChange\ChangeDetectionType;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsPageExactChange\TargetType;

/**
 * @phpstan-type MonitorsPageExactChangeShape = array{
 *   id: string,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   detectedAt: \DateTimeInterface,
 *   diff: string,
 *   monitorID: string,
 *   summary: string,
 *   targetType: TargetType|value-of<TargetType>,
 *   title: string,
 *   url: string,
 *   afterTextExcerpt?: string|null,
 *   beforeTextExcerpt?: string|null,
 *   tags?: list<string>|null,
 * }
 */
final class MonitorsPageExactChange implements BaseModel
{
    /** @use SdkModel<MonitorsPageExactChangeShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var value-of<ChangeDetectionType> $changeDetectionType */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    #[Required('detected_at')]
    public \DateTimeInterface $detectedAt;

    /**
     * Text diff between the previous and current page baseline.
     */
    #[Required]
    public string $diff;

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

    #[Optional('after_text_excerpt')]
    public ?string $afterTextExcerpt;

    #[Optional('before_text_excerpt')]
    public ?string $beforeTextExcerpt;

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new MonitorsPageExactChange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsPageExactChange::with(
     *   id: ...,
     *   changeDetectionType: ...,
     *   detectedAt: ...,
     *   diff: ...,
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
     * (new MonitorsPageExactChange)
     *   ->withID(...)
     *   ->withChangeDetectionType(...)
     *   ->withDetectedAt(...)
     *   ->withDiff(...)
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
     * @param TargetType|value-of<TargetType> $targetType
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        ChangeDetectionType|string $changeDetectionType,
        \DateTimeInterface $detectedAt,
        string $diff,
        string $monitorID,
        string $summary,
        TargetType|string $targetType,
        string $title,
        string $url,
        ?string $afterTextExcerpt = null,
        ?string $beforeTextExcerpt = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['detectedAt'] = $detectedAt;
        $self['diff'] = $diff;
        $self['monitorID'] = $monitorID;
        $self['summary'] = $summary;
        $self['targetType'] = $targetType;
        $self['title'] = $title;
        $self['url'] = $url;

        null !== $afterTextExcerpt && $self['afterTextExcerpt'] = $afterTextExcerpt;
        null !== $beforeTextExcerpt && $self['beforeTextExcerpt'] = $beforeTextExcerpt;
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
     * Text diff between the previous and current page baseline.
     */
    public function withDiff(string $diff): self
    {
        $self = clone $this;
        $self['diff'] = $diff;

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

    public function withAfterTextExcerpt(string $afterTextExcerpt): self
    {
        $self = clone $this;
        $self['afterTextExcerpt'] = $afterTextExcerpt;

        return $self;
    }

    public function withBeforeTextExcerpt(string $beforeTextExcerpt): self
    {
        $self = clone $this;
        $self['beforeTextExcerpt'] = $beforeTextExcerpt;

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
