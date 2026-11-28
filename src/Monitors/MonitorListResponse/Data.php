<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsExtractBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsPageBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSearchBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\Baseline\MonitorsSitemapBaseline;
use ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection;
use ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection\MonitorsSemanticChangeDetection;
use ContextDev\Monitors\MonitorListResponse\Data\LastError;
use ContextDev\Monitors\MonitorListResponse\Data\Mode;
use ContextDev\Monitors\MonitorListResponse\Data\Schedule;
use ContextDev\Monitors\MonitorListResponse\Data\Status;
use ContextDev\Monitors\MonitorListResponse\Data\Target;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsSearchTarget;
use ContextDev\Monitors\MonitorListResponse\Data\Target\MonitorsSitemapTarget;
use ContextDev\Monitors\MonitorListResponse\Data\Webhook;
use ContextDev\Monitors\MonitorListResponse\Data\WebhookFailure;

/**
 * A monitor checks a web page, sitemap, site data, or web search on a schedule and records each change it detects. `target` sets what to watch, `change_detection` how changes are judged, and `schedule` how often it runs.
 *
 * @phpstan-import-type ChangeDetectionVariants from \ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection
 * @phpstan-import-type TargetVariants from \ContextDev\Monitors\MonitorListResponse\Data\Target
 * @phpstan-import-type BaselineVariants from \ContextDev\Monitors\MonitorListResponse\Data\Baseline
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorListResponse\Data\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorListResponse\Data\Schedule
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorListResponse\Data\Target
 * @phpstan-import-type BaselineShape from \ContextDev\Monitors\MonitorListResponse\Data\Baseline
 * @phpstan-import-type LastErrorShape from \ContextDev\Monitors\MonitorListResponse\Data\LastError
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorListResponse\Data\Webhook
 * @phpstan-import-type WebhookFailureShape from \ContextDev\Monitors\MonitorListResponse\Data\WebhookFailure
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   changeDetection: ChangeDetectionShape,
 *   createdAt: \DateTimeInterface,
 *   mode: Mode|value-of<Mode>,
 *   name: string,
 *   schedule: Schedule|ScheduleShape,
 *   status: Status|value-of<Status>,
 *   target: TargetShape,
 *   updatedAt: \DateTimeInterface,
 *   baseline?: BaselineShape|null,
 *   lastChangeAt?: \DateTimeInterface|null,
 *   lastError?: null|LastError|LastErrorShape,
 *   lastRunAt?: \DateTimeInterface|null,
 *   nextRunAt?: \DateTimeInterface|null,
 *   policies?: list<string>|null,
 *   tags?: list<string>|null,
 *   webhook?: null|Webhook|WebhookShape,
 *   webhookFailure?: null|WebhookFailure|WebhookFailureShape,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique ID of the monitor.
     */
    #[Required]
    public string $id;

    /**
     * How changes are judged. Defaults to `semantic` for extract and search targets and for page targets with `instructions`; otherwise `exact`. Sitemap targets support only `exact`, and extract targets only `semantic`.
     *
     * @var ChangeDetectionVariants $changeDetection
     */
    #[Required('change_detection', union: ChangeDetection::class)]
    public MonitorsExactChangeDetection|MonitorsSemanticChangeDetection $changeDetection;

    /**
     * When the monitor was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Monitor category. Always `web`.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Display name of the monitor.
     */
    #[Required]
    public string $name;

    /**
     * Run the monitor at a fixed interval, such as every 6 hours or every 2 days. The interval must be between 10 minutes and 1 year.
     */
    #[Required]
    public Schedule $schedule;

    /**
     * `active` monitors run on schedule. `failed` monitors keep running after a failed run and return to `active` on the next success. `paused` monitors don't run until you set `status` to `active`; Context.dev also pauses monitors after repeated failures or credit shortfalls.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * What to watch: a page, a sitemap, data extracted from a site, or web search results.
     *
     * @var TargetVariants $target
     */
    #[Required(union: Target::class)]
    public MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget|MonitorsSearchTarget $target;

    /**
     * When the monitor was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * What the next run compares against. Returned only by `GET /monitors/{monitor_id}`; `null` until the first capture finishes or after the target changes.
     *
     * @var BaselineVariants|null $baseline
     */
    #[Optional(nullable: true)]
    public MonitorsPageBaseline|MonitorsSitemapBaseline|MonitorsExtractBaseline|MonitorsSearchBaseline|null $baseline;

    /**
     * When the monitor last detected a change. `null` until it detects one.
     */
    #[Optional('last_change_at', nullable: true)]
    public ?\DateTimeInterface $lastChangeAt;

    /**
     * Error from the most recent failed run. `null` when the last run succeeded.
     */
    #[Optional('last_error', nullable: true)]
    public ?LastError $lastError;

    /**
     * When the most recent run ended. `null` until the first run ends.
     */
    #[Optional('last_run_at', nullable: true)]
    public ?\DateTimeInterface $lastRunAt;

    /**
     * When the next scheduled run is due. `null` while paused.
     */
    #[Optional('next_run_at', nullable: true)]
    public ?\DateTimeInterface $nextRunAt;

    /**
     * Access policy IDs applied to every run.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Labels for grouping monitors. Filter monitors, changes, and credit usage by tag.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Webhook that receives monitor events. `null` when no webhook is configured.
     */
    #[Optional(nullable: true)]
    public ?Webhook $webhook;

    /**
     * Details of failing webhook deliveries. `null` when deliveries succeed or no webhook is configured; cleared by the next successful delivery or a new webhook URL.
     */
    #[Optional('webhook_failure', nullable: true)]
    public ?WebhookFailure $webhookFailure;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   changeDetection: ...,
     *   createdAt: ...,
     *   mode: ...,
     *   name: ...,
     *   schedule: ...,
     *   status: ...,
     *   target: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withID(...)
     *   ->withChangeDetection(...)
     *   ->withCreatedAt(...)
     *   ->withMode(...)
     *   ->withName(...)
     *   ->withSchedule(...)
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
     * @param Schedule|ScheduleShape $schedule
     * @param Status|value-of<Status> $status
     * @param TargetShape $target
     * @param BaselineShape|null $baseline
     * @param LastError|LastErrorShape|null $lastError
     * @param list<string>|null $policies
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     * @param WebhookFailure|WebhookFailureShape|null $webhookFailure
     */
    public static function with(
        string $id,
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection $changeDetection,
        \DateTimeInterface $createdAt,
        Mode|string $mode,
        string $name,
        Schedule|array $schedule,
        Status|string $status,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget|MonitorsSearchTarget $target,
        \DateTimeInterface $updatedAt,
        MonitorsPageBaseline|array|MonitorsSitemapBaseline|MonitorsExtractBaseline|MonitorsSearchBaseline|null $baseline = null,
        ?\DateTimeInterface $lastChangeAt = null,
        LastError|array|null $lastError = null,
        ?\DateTimeInterface $lastRunAt = null,
        ?\DateTimeInterface $nextRunAt = null,
        ?array $policies = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
        WebhookFailure|array|null $webhookFailure = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['changeDetection'] = $changeDetection;
        $self['createdAt'] = $createdAt;
        $self['mode'] = $mode;
        $self['name'] = $name;
        $self['schedule'] = $schedule;
        $self['status'] = $status;
        $self['target'] = $target;
        $self['updatedAt'] = $updatedAt;

        null !== $baseline && $self['baseline'] = $baseline;
        null !== $lastChangeAt && $self['lastChangeAt'] = $lastChangeAt;
        null !== $lastError && $self['lastError'] = $lastError;
        null !== $lastRunAt && $self['lastRunAt'] = $lastRunAt;
        null !== $nextRunAt && $self['nextRunAt'] = $nextRunAt;
        null !== $policies && $self['policies'] = $policies;
        null !== $tags && $self['tags'] = $tags;
        null !== $webhook && $self['webhook'] = $webhook;
        null !== $webhookFailure && $self['webhookFailure'] = $webhookFailure;

        return $self;
    }

    /**
     * Unique ID of the monitor.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * How changes are judged. Defaults to `semantic` for extract and search targets and for page targets with `instructions`; otherwise `exact`. Sitemap targets support only `exact`, and extract targets only `semantic`.
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

    /**
     * When the monitor was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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
     * Display name of the monitor.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Run the monitor at a fixed interval, such as every 6 hours or every 2 days. The interval must be between 10 minutes and 1 year.
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
     * `active` monitors run on schedule. `failed` monitors keep running after a failed run and return to `active` on the next success. `paused` monitors don't run until you set `status` to `active`; Context.dev also pauses monitors after repeated failures or credit shortfalls.
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
     * What to watch: a page, a sitemap, data extracted from a site, or web search results.
     *
     * @param TargetShape $target
     */
    public function withTarget(
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget|MonitorsSearchTarget $target,
    ): self {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }

    /**
     * When the monitor was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * What the next run compares against. Returned only by `GET /monitors/{monitor_id}`; `null` until the first capture finishes or after the target changes.
     *
     * @param BaselineShape|null $baseline
     */
    public function withBaseline(
        MonitorsPageBaseline|array|MonitorsSitemapBaseline|MonitorsExtractBaseline|MonitorsSearchBaseline|null $baseline,
    ): self {
        $self = clone $this;
        $self['baseline'] = $baseline;

        return $self;
    }

    /**
     * When the monitor last detected a change. `null` until it detects one.
     */
    public function withLastChangeAt(?\DateTimeInterface $lastChangeAt): self
    {
        $self = clone $this;
        $self['lastChangeAt'] = $lastChangeAt;

        return $self;
    }

    /**
     * Error from the most recent failed run. `null` when the last run succeeded.
     *
     * @param LastError|LastErrorShape|null $lastError
     */
    public function withLastError(LastError|array|null $lastError): self
    {
        $self = clone $this;
        $self['lastError'] = $lastError;

        return $self;
    }

    /**
     * When the most recent run ended. `null` until the first run ends.
     */
    public function withLastRunAt(?\DateTimeInterface $lastRunAt): self
    {
        $self = clone $this;
        $self['lastRunAt'] = $lastRunAt;

        return $self;
    }

    /**
     * When the next scheduled run is due. `null` while paused.
     */
    public function withNextRunAt(?\DateTimeInterface $nextRunAt): self
    {
        $self = clone $this;
        $self['nextRunAt'] = $nextRunAt;

        return $self;
    }

    /**
     * Access policy IDs applied to every run.
     *
     * @param list<string> $policies
     */
    public function withPolicies(array $policies): self
    {
        $self = clone $this;
        $self['policies'] = $policies;

        return $self;
    }

    /**
     * Labels for grouping monitors. Filter monitors, changes, and credit usage by tag.
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
     * Webhook that receives monitor events. `null` when no webhook is configured.
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
     * Details of failing webhook deliveries. `null` when deliveries succeed or no webhook is configured; cleared by the next successful delivery or a new webhook URL.
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
