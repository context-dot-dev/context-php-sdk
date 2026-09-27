<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorNewResponse\Baseline\MonitorsExtractBaseline;
use ContextDev\Monitors\MonitorNewResponse\Baseline\MonitorsPageBaseline;
use ContextDev\Monitors\MonitorNewResponse\Baseline\MonitorsSitemapBaseline;
use ContextDev\Monitors\MonitorNewResponse\ChangeDetection;
use ContextDev\Monitors\MonitorNewResponse\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorNewResponse\ChangeDetection\MonitorsSemanticChangeDetection;
use ContextDev\Monitors\MonitorNewResponse\KeyMetadata;
use ContextDev\Monitors\MonitorNewResponse\LastError;
use ContextDev\Monitors\MonitorNewResponse\Mode;
use ContextDev\Monitors\MonitorNewResponse\Schedule;
use ContextDev\Monitors\MonitorNewResponse\Status;
use ContextDev\Monitors\MonitorNewResponse\Target;
use ContextDev\Monitors\MonitorNewResponse\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorNewResponse\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorNewResponse\Target\MonitorsSitemapTarget;
use ContextDev\Monitors\MonitorNewResponse\Webhook;
use ContextDev\Monitors\MonitorNewResponse\WebhookFailure;

/**
 * @phpstan-import-type ChangeDetectionVariants from \ContextDev\Monitors\MonitorNewResponse\ChangeDetection
 * @phpstan-import-type TargetVariants from \ContextDev\Monitors\MonitorNewResponse\Target
 * @phpstan-import-type BaselineVariants from \ContextDev\Monitors\MonitorNewResponse\Baseline
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorNewResponse\ChangeDetection
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorNewResponse\Target
 * @phpstan-import-type BaselineShape from \ContextDev\Monitors\MonitorNewResponse\Baseline
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Monitors\MonitorNewResponse\KeyMetadata
 * @phpstan-import-type LastErrorShape from \ContextDev\Monitors\MonitorNewResponse\LastError
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorNewResponse\Schedule
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorNewResponse\Webhook
 * @phpstan-import-type WebhookFailureShape from \ContextDev\Monitors\MonitorNewResponse\WebhookFailure
 *
 * @phpstan-type MonitorNewResponseShape = array{
 *   id: string,
 *   changeDetection: ChangeDetectionShape,
 *   createdAt: \DateTimeInterface,
 *   initialRunID: string|null,
 *   mode: Mode|value-of<Mode>,
 *   name: string,
 *   requestID: string,
 *   status: Status|value-of<Status>,
 *   target: TargetShape,
 *   updatedAt: \DateTimeInterface,
 *   baseline?: BaselineShape|null,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   lastChangeAt?: \DateTimeInterface|null,
 *   lastError?: null|LastError|LastErrorShape,
 *   lastRunAt?: \DateTimeInterface|null,
 *   nextRunAt?: \DateTimeInterface|null,
 *   schedule?: null|Schedule|ScheduleShape,
 *   tags?: list<string>|null,
 *   webhook?: null|Webhook|WebhookShape,
 *   webhookFailure?: null|WebhookFailure|WebhookFailureShape,
 * }
 */
final class MonitorNewResponse implements BaseModel
{
    /** @use SdkModel<MonitorNewResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * How changes are judged. Defaults to `semantic` for extract targets and page targets with `instructions`, otherwise `exact`.
     *
     * @var ChangeDetectionVariants $changeDetection
     */
    #[Required('change_detection', union: ChangeDetection::class)]
    public MonitorsExactChangeDetection|MonitorsSemanticChangeDetection $changeDetection;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * ID of the baseline run queued at creation; null if it will start on the next scheduled tick.
     */
    #[Required('initial_run_id')]
    public ?string $initialRunID;

    /**
     * Always `web`. Optional.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    #[Required]
    public string $name;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Current state. Failed monitors keep running; paused monitors must be resumed with `status: "active"`.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * What to watch: a page, a sitemap, or data extracted from a site.
     *
     * @var TargetVariants $target
     */
    #[Required(union: Target::class)]
    public MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget $target;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Comparison baseline, included on Retrieve. Null until capture completes or after target changes.
     *
     * @var BaselineVariants|null $baseline
     */
    #[Optional(nullable: true)]
    public MonitorsPageBaseline|MonitorsSitemapBaseline|MonitorsExtractBaseline|null $baseline;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    #[Optional('last_change_at', nullable: true)]
    public ?\DateTimeInterface $lastChangeAt;

    /**
     * Error from the most recent failed run; null when the last run succeeded.
     */
    #[Optional('last_error', nullable: true)]
    public ?LastError $lastError;

    #[Optional('last_run_at', nullable: true)]
    public ?\DateTimeInterface $lastRunAt;

    /**
     * When the next scheduled run is due; null while paused.
     */
    #[Optional('next_run_at', nullable: true)]
    public ?\DateTimeInterface $nextRunAt;

    /**
     * Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     */
    #[Optional]
    public ?Schedule $schedule;

    /**
     * Labels for filtering monitors, their changes, and their usage.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Webhook destination and delivery settings. Null means no webhook is configured.
     */
    #[Optional(nullable: true)]
    public ?Webhook $webhook;

    /**
     * Present while webhook deliveries are failing consecutively; null when deliveries are healthy or no webhook is configured. Cleared on the next successful delivery and when the webhook URL changes.
     */
    #[Optional('webhook_failure', nullable: true)]
    public ?WebhookFailure $webhookFailure;

    /**
     * `new MonitorNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorNewResponse::with(
     *   id: ...,
     *   changeDetection: ...,
     *   createdAt: ...,
     *   initialRunID: ...,
     *   mode: ...,
     *   name: ...,
     *   requestID: ...,
     *   status: ...,
     *   target: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorNewResponse)
     *   ->withID(...)
     *   ->withChangeDetection(...)
     *   ->withCreatedAt(...)
     *   ->withInitialRunID(...)
     *   ->withMode(...)
     *   ->withName(...)
     *   ->withRequestID(...)
     *   ->withStatus(...)
     *   ->withTarget(...)
     *   ->withUpdatedAt(...)
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
     * @param ChangeDetectionShape $changeDetection
     * @param Mode|value-of<Mode> $mode
     * @param Status|value-of<Status> $status
     * @param TargetShape $target
     * @param BaselineShape|null $baseline
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     * @param LastError|LastErrorShape|null $lastError
     * @param Schedule|ScheduleShape|null $schedule
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     * @param WebhookFailure|WebhookFailureShape|null $webhookFailure
     */
    public static function with(
        string $id,
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection $changeDetection,
        \DateTimeInterface $createdAt,
        ?string $initialRunID,
        Mode|string $mode,
        string $name,
        string $requestID,
        Status|string $status,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget $target,
        \DateTimeInterface $updatedAt,
        MonitorsPageBaseline|array|MonitorsSitemapBaseline|MonitorsExtractBaseline|null $baseline = null,
        KeyMetadata|array|null $keyMetadata = null,
        ?\DateTimeInterface $lastChangeAt = null,
        LastError|array|null $lastError = null,
        ?\DateTimeInterface $lastRunAt = null,
        ?\DateTimeInterface $nextRunAt = null,
        Schedule|array|null $schedule = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        WebhookFailure|array|null $webhookFailure = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['changeDetection'] = $changeDetection;
        $self['createdAt'] = $createdAt;
        $self['initialRunID'] = $initialRunID;
        $self['mode'] = $mode;
        $self['name'] = $name;
        $self['requestID'] = $requestID;
        $self['status'] = $status;
        $self['target'] = $target;
        $self['updatedAt'] = $updatedAt;

        null !== $baseline && $self['baseline'] = $baseline;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $lastChangeAt && $self['lastChangeAt'] = $lastChangeAt;
        null !== $lastError && $self['lastError'] = $lastError;
        null !== $lastRunAt && $self['lastRunAt'] = $lastRunAt;
        null !== $nextRunAt && $self['nextRunAt'] = $nextRunAt;
        null !== $schedule && $self['schedule'] = $schedule;
        null !== $tags && $self['tags'] = $tags;
        null !== $webhook && $self['webhook'] = $webhook;
        null !== $webhookFailure && $self['webhookFailure'] = $webhookFailure;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * How changes are judged. Defaults to `semantic` for extract targets and page targets with `instructions`, otherwise `exact`.
     *
     * @param ChangeDetectionShape $changeDetection
     */
    public function withChangeDetection(
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection $changeDetection,
    ): self {
        $self = clone $this;
        $self['changeDetection'] = $changeDetection;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * ID of the baseline run queued at creation; null if it will start on the next scheduled tick.
     */
    public function withInitialRunID(?string $initialRunID): self
    {
        $self = clone $this;
        $self['initialRunID'] = $initialRunID;

        return $self;
    }

    /**
     * Always `web`. Optional.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * Current state. Failed monitors keep running; paused monitors must be resumed with `status: "active"`.
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
     * What to watch: a page, a sitemap, or data extracted from a site.
     *
     * @param TargetShape $target
     */
    public function withTarget(
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget $target
    ): self {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Comparison baseline, included on Retrieve. Null until capture completes or after target changes.
     *
     * @param BaselineShape|null $baseline
     */
    public function withBaseline(
        MonitorsPageBaseline|array|MonitorsSitemapBaseline|MonitorsExtractBaseline|null $baseline,
    ): self {
        $self = clone $this;
        $self['baseline'] = $baseline;

        return $self;
    }

    /**
     * Credits this request used and your remaining balance.
     *
     * @param KeyMetadata|KeyMetadataShape $keyMetadata
     */
    public function withKeyMetadata(KeyMetadata|array $keyMetadata): self
    {
        $self = clone $this;
        $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    public function withLastChangeAt(?\DateTimeInterface $lastChangeAt): self
    {
        $self = clone $this;
        $self['lastChangeAt'] = $lastChangeAt;

        return $self;
    }

    /**
     * Error from the most recent failed run; null when the last run succeeded.
     *
     * @param LastError|LastErrorShape|null $lastError
     */
    public function withLastError(LastError|array|null $lastError): self
    {
        $self = clone $this;
        $self['lastError'] = $lastError;

        return $self;
    }

    public function withLastRunAt(?\DateTimeInterface $lastRunAt): self
    {
        $self = clone $this;
        $self['lastRunAt'] = $lastRunAt;

        return $self;
    }

    /**
     * When the next scheduled run is due; null while paused.
     */
    public function withNextRunAt(?\DateTimeInterface $nextRunAt): self
    {
        $self = clone $this;
        $self['nextRunAt'] = $nextRunAt;

        return $self;
    }

    /**
     * Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     *
     * @param Schedule|ScheduleShape $schedule
     */
    public function withSchedule(Schedule|array $schedule): self
    {
        $self = clone $this;
        $self['schedule'] = $schedule;

        return $self;
    }

    /**
     * Labels for filtering monitors, their changes, and their usage.
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
     * Webhook destination and delivery settings. Null means no webhook is configured.
     *
     * @param Webhook|WebhookShape|null $webhook
     */
    public function withWebhook(Webhook|array|null $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }

    /**
     * Present while webhook deliveries are failing consecutively; null when deliveries are healthy or no webhook is configured. Cleared on the next successful delivery and when the webhook URL changes.
     *
     * @param WebhookFailure|WebhookFailureShape|null $webhookFailure
     */
    public function withWebhookFailure(
        WebhookFailure|array|null $webhookFailure
    ): self {
        $self = clone $this;
        $self['webhookFailure'] = $webhookFailure;

        return $self;
    }
}
