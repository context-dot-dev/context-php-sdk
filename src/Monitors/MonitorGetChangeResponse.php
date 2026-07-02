<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetChangeResponse\ChangeDetectionType;
use ContextDev\Monitors\MonitorGetChangeResponse\Evidence;
use ContextDev\Monitors\MonitorGetChangeResponse\Importance;
use ContextDev\Monitors\MonitorGetChangeResponse\Mode;
use ContextDev\Monitors\MonitorGetChangeResponse\TargetType;

/**
 * A detected change. `mode` is the constant `web`; `target_type` and `change_detection_type` describe the change, and which optional fields are present depends on them (page: `diff` + excerpts; sitemap: `added_urls`/`removed_urls`; semantic: `query`/`confidence`/`importance`/`evidence`/`matched_urls`).
 *
 * @phpstan-import-type EvidenceShape from \ContextDev\Monitors\MonitorGetChangeResponse\Evidence
 *
 * @phpstan-type MonitorGetChangeResponseShape = array{
 *   id: string,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   detectedAt: \DateTimeInterface,
 *   mode: Mode|value-of<Mode>,
 *   monitorID: string,
 *   runID: string,
 *   summary: string,
 *   targetType: TargetType|value-of<TargetType>,
 *   title: string,
 *   url: string,
 *   addedURLCount?: int|null,
 *   addedURLs?: list<string>|null,
 *   afterTextExcerpt?: string|null,
 *   beforeTextExcerpt?: string|null,
 *   confidence?: float|null,
 *   diff?: string|null,
 *   evidence?: list<Evidence|EvidenceShape>|null,
 *   importance?: null|Importance|value-of<Importance>,
 *   matchedURLCount?: int|null,
 *   matchedURLs?: list<string>|null,
 *   query?: string|null,
 *   removedURLCount?: int|null,
 *   removedURLs?: list<string>|null,
 *   tags?: list<string>|null,
 * }
 */
final class MonitorGetChangeResponse implements BaseModel
{
    /** @use SdkModel<MonitorGetChangeResponseShape> */
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

    /**
     * The run that detected this change.
     */
    #[Required('run_id')]
    public string $runID;

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

    /**
     * At most 500 URLs are included; the corresponding count field is always exact.
     *
     * @var list<string>|null $addedURLs
     */
    #[Optional('added_urls', list: 'string')]
    public ?array $addedURLs;

    #[Optional('after_text_excerpt')]
    public ?string $afterTextExcerpt;

    #[Optional('before_text_excerpt')]
    public ?string $beforeTextExcerpt;

    #[Optional]
    public ?float $confidence;

    /**
     * Text diff between the previous and current page baseline (page targets).
     */
    #[Optional]
    public ?string $diff;

    /** @var list<Evidence>|null $evidence */
    #[Optional(list: Evidence::class)]
    public ?array $evidence;

    /** @var value-of<Importance>|null $importance */
    #[Optional(enum: Importance::class)]
    public ?string $importance;

    #[Optional('matched_url_count')]
    public ?int $matchedURLCount;

    /**
     * At most 500 URLs are included; the corresponding count field is always exact.
     *
     * @var list<string>|null $matchedURLs
     */
    #[Optional('matched_urls', list: 'string')]
    public ?array $matchedURLs;

    #[Optional]
    public ?string $query;

    #[Optional('removed_url_count')]
    public ?int $removedURLCount;

    /**
     * At most 500 URLs are included; the corresponding count field is always exact.
     *
     * @var list<string>|null $removedURLs
     */
    #[Optional('removed_urls', list: 'string')]
    public ?array $removedURLs;

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new MonitorGetChangeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorGetChangeResponse::with(
     *   id: ...,
     *   changeDetectionType: ...,
     *   detectedAt: ...,
     *   mode: ...,
     *   monitorID: ...,
     *   runID: ...,
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
     * (new MonitorGetChangeResponse)
     *   ->withID(...)
     *   ->withChangeDetectionType(...)
     *   ->withDetectedAt(...)
     *   ->withMode(...)
     *   ->withMonitorID(...)
     *   ->withRunID(...)
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
     * @param list<string>|null $addedURLs
     * @param list<Evidence|EvidenceShape>|null $evidence
     * @param Importance|value-of<Importance>|null $importance
     * @param list<string>|null $matchedURLs
     * @param list<string>|null $removedURLs
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        ChangeDetectionType|string $changeDetectionType,
        \DateTimeInterface $detectedAt,
        Mode|string $mode,
        string $monitorID,
        string $runID,
        string $summary,
        TargetType|string $targetType,
        string $title,
        string $url,
        ?int $addedURLCount = null,
        ?array $addedURLs = null,
        ?string $afterTextExcerpt = null,
        ?string $beforeTextExcerpt = null,
        ?float $confidence = null,
        ?string $diff = null,
        ?array $evidence = null,
        Importance|string|null $importance = null,
        ?int $matchedURLCount = null,
        ?array $matchedURLs = null,
        ?string $query = null,
        ?int $removedURLCount = null,
        ?array $removedURLs = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['detectedAt'] = $detectedAt;
        $self['mode'] = $mode;
        $self['monitorID'] = $monitorID;
        $self['runID'] = $runID;
        $self['summary'] = $summary;
        $self['targetType'] = $targetType;
        $self['title'] = $title;
        $self['url'] = $url;

        null !== $addedURLCount && $self['addedURLCount'] = $addedURLCount;
        null !== $addedURLs && $self['addedURLs'] = $addedURLs;
        null !== $afterTextExcerpt && $self['afterTextExcerpt'] = $afterTextExcerpt;
        null !== $beforeTextExcerpt && $self['beforeTextExcerpt'] = $beforeTextExcerpt;
        null !== $confidence && $self['confidence'] = $confidence;
        null !== $diff && $self['diff'] = $diff;
        null !== $evidence && $self['evidence'] = $evidence;
        null !== $importance && $self['importance'] = $importance;
        null !== $matchedURLCount && $self['matchedURLCount'] = $matchedURLCount;
        null !== $matchedURLs && $self['matchedURLs'] = $matchedURLs;
        null !== $query && $self['query'] = $query;
        null !== $removedURLCount && $self['removedURLCount'] = $removedURLCount;
        null !== $removedURLs && $self['removedURLs'] = $removedURLs;
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

    /**
     * The run that detected this change.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

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

    /**
     * At most 500 URLs are included; the corresponding count field is always exact.
     *
     * @param list<string> $addedURLs
     */
    public function withAddedURLs(array $addedURLs): self
    {
        $self = clone $this;
        $self['addedURLs'] = $addedURLs;

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

    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Text diff between the previous and current page baseline (page targets).
     */
    public function withDiff(string $diff): self
    {
        $self = clone $this;
        $self['diff'] = $diff;

        return $self;
    }

    /**
     * @param list<Evidence|EvidenceShape> $evidence
     */
    public function withEvidence(array $evidence): self
    {
        $self = clone $this;
        $self['evidence'] = $evidence;

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

    /**
     * At most 500 URLs are included; the corresponding count field is always exact.
     *
     * @param list<string> $matchedURLs
     */
    public function withMatchedURLs(array $matchedURLs): self
    {
        $self = clone $this;
        $self['matchedURLs'] = $matchedURLs;

        return $self;
    }

    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    public function withRemovedURLCount(int $removedURLCount): self
    {
        $self = clone $this;
        $self['removedURLCount'] = $removedURLCount;

        return $self;
    }

    /**
     * At most 500 URLs are included; the corresponding count field is always exact.
     *
     * @param list<string> $removedURLs
     */
    public function withRemovedURLs(array $removedURLs): self
    {
        $self = clone $this;
        $self['removedURLs'] = $removedURLs;

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
