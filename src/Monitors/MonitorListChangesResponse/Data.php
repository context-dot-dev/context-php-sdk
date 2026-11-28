<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListChangesResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListChangesResponse\Data\ChangeDetectionType;
use ContextDev\Monitors\MonitorListChangesResponse\Data\Evidence;
use ContextDev\Monitors\MonitorListChangesResponse\Data\Importance;
use ContextDev\Monitors\MonitorListChangesResponse\Data\Mode;
use ContextDev\Monitors\MonitorListChangesResponse\Data\TargetType;

/**
 * A change detected by a monitor run, with a summary and, depending on the target, a text diff, added or removed URLs, matched results, and evidence.
 *
 * @phpstan-import-type EvidenceShape from \ContextDev\Monitors\MonitorListChangesResponse\Data\Evidence
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   detectedAt: \DateTimeInterface,
 *   mode: Mode|value-of<Mode>,
 *   monitorID: string,
 *   runID: string,
 *   summary: string,
 *   tags: list<string>,
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
 *   removedURLCount?: int|null,
 *   removedURLs?: list<string>|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique ID of the change.
     */
    #[Required]
    public string $id;

    /**
     * Change detection type the monitor uses.
     *
     * @var value-of<ChangeDetectionType> $changeDetectionType
     */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    /**
     * When the change was detected.
     */
    #[Required('detected_at')]
    public \DateTimeInterface $detectedAt;

    /**
     * Monitor category. Always `web`.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * ID of the monitor that detected the change.
     */
    #[Required('monitor_id')]
    public string $monitorID;

    /**
     * ID of the run that detected the change.
     */
    #[Required('run_id')]
    public string $runID;

    /**
     * Plain-language summary of what changed.
     */
    #[Required]
    public string $summary;

    /**
     * Tags the monitor had when the change was detected.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * Type of target the monitor watches.
     *
     * @var value-of<TargetType> $targetType
     */
    #[Required('target_type', enum: TargetType::class)]
    public string $targetType;

    /**
     * Short headline for the change.
     */
    #[Required]
    public string $title;

    /**
     * Monitored URL. For search targets, the first new result.
     */
    #[Required]
    public string $url;

    /**
     * Total number of URLs added.
     */
    #[Optional('added_url_count')]
    public ?int $addedURLCount;

    /**
     * URLs added to the sitemap, up to 500. `added_url_count` has the full count.
     *
     * @var list<string>|null $addedURLs
     */
    #[Optional('added_urls', list: 'string')]
    public ?array $addedURLs;

    /**
     * Excerpt of the page text after the change. Page targets only.
     */
    #[Optional('after_text_excerpt')]
    public ?string $afterTextExcerpt;

    /**
     * Excerpt of the page text before the change. Page targets only.
     */
    #[Optional('before_text_excerpt')]
    public ?string $beforeTextExcerpt;

    /**
     * Confidence that the change matters, from 0 to 1. Set by `semantic` detection only.
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Text diff of the change, for page and extract targets. Extract diffs have one section per changed page.
     */
    #[Optional]
    public ?string $diff;

    /**
     * Before and after excerpts that support the change.
     *
     * @var list<Evidence>|null $evidence
     */
    #[Optional(list: Evidence::class)]
    public ?array $evidence;

    /**
     * How important the change is. Set by `semantic` detection only.
     *
     * @var value-of<Importance>|null $importance
     */
    #[Optional(enum: Importance::class)]
    public ?string $importance;

    /**
     * Total number of matched URLs.
     */
    #[Optional('matched_url_count')]
    public ?int $matchedURLCount;

    /**
     * URLs where the change was found: the changed pages for page and extract targets, or the new results for search targets. Up to 500; `matched_url_count` has the full count.
     *
     * @var list<string>|null $matchedURLs
     */
    #[Optional('matched_urls', list: 'string')]
    public ?array $matchedURLs;

    /**
     * Total number of URLs removed.
     */
    #[Optional('removed_url_count')]
    public ?int $removedURLCount;

    /**
     * URLs removed from the sitemap, or pages no longer found for extract targets, up to 500. `removed_url_count` has the full count.
     *
     * @var list<string>|null $removedURLs
     */
    #[Optional('removed_urls', list: 'string')]
    public ?array $removedURLs;

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
     *   runID: ...,
     *   summary: ...,
     *   tags: ...,
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
     *   ->withRunID(...)
     *   ->withSummary(...)
     *   ->withTags(...)
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
     * @param list<string> $tags
     * @param TargetType|value-of<TargetType> $targetType
     * @param list<string>|null $addedURLs
     * @param list<Evidence|EvidenceShape>|null $evidence
     * @param Importance|value-of<Importance>|null $importance
     * @param list<string>|null $matchedURLs
     * @param list<string>|null $removedURLs
     */
    public static function with(
        string $id,
        ChangeDetectionType|string $changeDetectionType,
        \DateTimeInterface $detectedAt,
        Mode|string $mode,
        string $monitorID,
        string $runID,
        string $summary,
        array $tags,
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
        ?int $removedURLCount = null,
        ?array $removedURLs = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['detectedAt'] = $detectedAt;
        $self['mode'] = $mode;
        $self['monitorID'] = $monitorID;
        $self['runID'] = $runID;
        $self['summary'] = $summary;
        $self['tags'] = $tags;
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
        null !== $removedURLCount && $self['removedURLCount'] = $removedURLCount;
        null !== $removedURLs && $self['removedURLs'] = $removedURLs;

        return $self;
    }

    /**
     * Unique ID of the change.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Change detection type the monitor uses.
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
     * When the change was detected.
     */
    public function withDetectedAt(\DateTimeInterface $detectedAt): self
    {
        $self = clone $this;
        $self['detectedAt'] = $detectedAt;

        return $self;
    }

    /**
     * Monitor category. Always `web`.
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
     * ID of the monitor that detected the change.
     */
    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    /**
     * ID of the run that detected the change.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }

    /**
     * Plain-language summary of what changed.
     */
    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * Tags the monitor had when the change was detected.
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
     * Type of target the monitor watches.
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
     * Short headline for the change.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Monitored URL. For search targets, the first new result.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Total number of URLs added.
     */
    public function withAddedURLCount(int $addedURLCount): self
    {
        $self = clone $this;
        $self['addedURLCount'] = $addedURLCount;

        return $self;
    }

    /**
     * URLs added to the sitemap, up to 500. `added_url_count` has the full count.
     *
     * @param list<string> $addedURLs
     */
    public function withAddedURLs(array $addedURLs): self
    {
        $self = clone $this;
        $self['addedURLs'] = $addedURLs;

        return $self;
    }

    /**
     * Excerpt of the page text after the change. Page targets only.
     */
    public function withAfterTextExcerpt(string $afterTextExcerpt): self
    {
        $self = clone $this;
        $self['afterTextExcerpt'] = $afterTextExcerpt;

        return $self;
    }

    /**
     * Excerpt of the page text before the change. Page targets only.
     */
    public function withBeforeTextExcerpt(string $beforeTextExcerpt): self
    {
        $self = clone $this;
        $self['beforeTextExcerpt'] = $beforeTextExcerpt;

        return $self;
    }

    /**
     * Confidence that the change matters, from 0 to 1. Set by `semantic` detection only.
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Text diff of the change, for page and extract targets. Extract diffs have one section per changed page.
     */
    public function withDiff(string $diff): self
    {
        $self = clone $this;
        $self['diff'] = $diff;

        return $self;
    }

    /**
     * Before and after excerpts that support the change.
     *
     * @param list<Evidence|EvidenceShape> $evidence
     */
    public function withEvidence(array $evidence): self
    {
        $self = clone $this;
        $self['evidence'] = $evidence;

        return $self;
    }

    /**
     * How important the change is. Set by `semantic` detection only.
     *
     * @param Importance|value-of<Importance> $importance
     */
    public function withImportance(Importance|string $importance): self
    {
        $self = clone $this;
        $self['importance'] = $importance;

        return $self;
    }

    /**
     * Total number of matched URLs.
     */
    public function withMatchedURLCount(int $matchedURLCount): self
    {
        $self = clone $this;
        $self['matchedURLCount'] = $matchedURLCount;

        return $self;
    }

    /**
     * URLs where the change was found: the changed pages for page and extract targets, or the new results for search targets. Up to 500; `matched_url_count` has the full count.
     *
     * @param list<string> $matchedURLs
     */
    public function withMatchedURLs(array $matchedURLs): self
    {
        $self = clone $this;
        $self['matchedURLs'] = $matchedURLs;

        return $self;
    }

    /**
     * Total number of URLs removed.
     */
    public function withRemovedURLCount(int $removedURLCount): self
    {
        $self = clone $this;
        $self['removedURLCount'] = $removedURLCount;

        return $self;
    }

    /**
     * URLs removed from the sitemap, or pages no longer found for extract targets, up to 500. `removed_url_count` has the full count.
     *
     * @param list<string> $removedURLs
     */
    public function withRemovedURLs(array $removedURLs): self
    {
        $self = clone $this;
        $self['removedURLs'] = $removedURLs;

        return $self;
    }
}
