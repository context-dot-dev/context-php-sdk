<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetChangeResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsSitemapExactChange\ChangeDetectionType;
use ContextDev\Monitors\MonitorGetChangeResponse\MonitorsSitemapExactChange\TargetType;

/**
 * @phpstan-type MonitorsSitemapExactChangeShape = array{
 *   id: string,
 *   addedURLCount: int,
 *   addedURLs: list<string>,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   detectedAt: \DateTimeInterface,
 *   monitorID: string,
 *   removedURLCount: int,
 *   removedURLs: list<string>,
 *   summary: string,
 *   targetType: TargetType|value-of<TargetType>,
 *   title: string,
 *   url: string,
 *   tags?: list<string>|null,
 * }
 */
final class MonitorsSitemapExactChange implements BaseModel
{
    /** @use SdkModel<MonitorsSitemapExactChangeShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('added_url_count')]
    public int $addedURLCount;

    /** @var list<string> $addedURLs */
    #[Required('added_urls', list: 'string')]
    public array $addedURLs;

    /** @var value-of<ChangeDetectionType> $changeDetectionType */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    #[Required('detected_at')]
    public \DateTimeInterface $detectedAt;

    #[Required('monitor_id')]
    public string $monitorID;

    #[Required('removed_url_count')]
    public int $removedURLCount;

    /** @var list<string> $removedURLs */
    #[Required('removed_urls', list: 'string')]
    public array $removedURLs;

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
     * `new MonitorsSitemapExactChange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsSitemapExactChange::with(
     *   id: ...,
     *   addedURLCount: ...,
     *   addedURLs: ...,
     *   changeDetectionType: ...,
     *   detectedAt: ...,
     *   monitorID: ...,
     *   removedURLCount: ...,
     *   removedURLs: ...,
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
     * (new MonitorsSitemapExactChange)
     *   ->withID(...)
     *   ->withAddedURLCount(...)
     *   ->withAddedURLs(...)
     *   ->withChangeDetectionType(...)
     *   ->withDetectedAt(...)
     *   ->withMonitorID(...)
     *   ->withRemovedURLCount(...)
     *   ->withRemovedURLs(...)
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
     * @param list<string> $addedURLs
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     * @param list<string> $removedURLs
     * @param TargetType|value-of<TargetType> $targetType
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        int $addedURLCount,
        array $addedURLs,
        ChangeDetectionType|string $changeDetectionType,
        \DateTimeInterface $detectedAt,
        string $monitorID,
        int $removedURLCount,
        array $removedURLs,
        string $summary,
        TargetType|string $targetType,
        string $title,
        string $url,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['addedURLCount'] = $addedURLCount;
        $self['addedURLs'] = $addedURLs;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['detectedAt'] = $detectedAt;
        $self['monitorID'] = $monitorID;
        $self['removedURLCount'] = $removedURLCount;
        $self['removedURLs'] = $removedURLs;
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
     * @param list<string> $addedURLs
     */
    public function withAddedURLs(array $addedURLs): self
    {
        $self = clone $this;
        $self['addedURLs'] = $addedURLs;

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

    /**
     * @param list<string> $removedURLs
     */
    public function withRemovedURLs(array $removedURLs): self
    {
        $self = clone $this;
        $self['removedURLs'] = $removedURLs;

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
