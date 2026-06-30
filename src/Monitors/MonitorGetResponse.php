<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetResponse\ChangeDetection;
use ContextDev\Monitors\MonitorGetResponse\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorGetResponse\ChangeDetection\MonitorsSemanticChangeDetection;
use ContextDev\Monitors\MonitorGetResponse\Mode;
use ContextDev\Monitors\MonitorGetResponse\Schedule;
use ContextDev\Monitors\MonitorGetResponse\Status;
use ContextDev\Monitors\MonitorGetResponse\Target;
use ContextDev\Monitors\MonitorGetResponse\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorGetResponse\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorGetResponse\Target\MonitorsSitemapTarget;
use ContextDev\Monitors\MonitorGetResponse\Webhook;

/**
 * A web monitor. `mode` is the constant `web`; behavior is described by `target` (page/sitemap/extract) and `change_detection` (exact/semantic).
 *
 * @phpstan-import-type ChangeDetectionVariants from \ContextDev\Monitors\MonitorGetResponse\ChangeDetection
 * @phpstan-import-type TargetVariants from \ContextDev\Monitors\MonitorGetResponse\Target
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorGetResponse\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorGetResponse\Schedule
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorGetResponse\Target
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorGetResponse\Webhook
 *
 * @phpstan-type MonitorGetResponseShape = array{
 *   id: string,
 *   changeDetection: ChangeDetectionShape,
 *   createdAt: \DateTimeInterface,
 *   mode: Mode|value-of<Mode>,
 *   name: string,
 *   schedule: Schedule|ScheduleShape,
 *   status: Status|value-of<Status>,
 *   target: TargetShape,
 *   updatedAt: \DateTimeInterface,
 *   lastChangeAt?: \DateTimeInterface|null,
 *   lastRunAt?: \DateTimeInterface|null,
 *   tags?: list<string>|null,
 *   webhook?: null|Webhook|WebhookShape,
 * }
 */
final class MonitorGetResponse implements BaseModel
{
    /** @use SdkModel<MonitorGetResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * Discriminated union describing how changes are detected.
     *
     * @var ChangeDetectionVariants $changeDetection
     */
    #[Required('change_detection', union: ChangeDetection::class)]
    public MonitorsExactChangeDetection|MonitorsSemanticChangeDetection $changeDetection;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Top-level monitor category. Always `web` today; the concrete behavior is described by `target` and `change_detection`.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    #[Required]
    public string $name;

    /**
     * Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     */
    #[Required]
    public Schedule $schedule;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Discriminated union describing what the monitor watches.
     *
     * @var TargetVariants $target
     */
    #[Required(union: Target::class)]
    public MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget $target;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional('last_change_at', nullable: true)]
    public ?\DateTimeInterface $lastChangeAt;

    #[Optional('last_run_at', nullable: true)]
    public ?\DateTimeInterface $lastRunAt;

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    #[Optional(nullable: true)]
    public ?Webhook $webhook;

    /**
     * `new MonitorGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorGetResponse::with(
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
     * (new MonitorGetResponse)
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
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        string $id,
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection $changeDetection,
        \DateTimeInterface $createdAt,
        Mode|string $mode,
        string $name,
        Schedule|array $schedule,
        Status|string $status,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget $target,
        \DateTimeInterface $updatedAt,
        ?\DateTimeInterface $lastChangeAt = null,
        ?\DateTimeInterface $lastRunAt = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
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

        null !== $lastChangeAt && $self['lastChangeAt'] = $lastChangeAt;
        null !== $lastRunAt && $self['lastRunAt'] = $lastRunAt;
        null !== $tags && $self['tags'] = $tags;
        null !== $webhook && $self['webhook'] = $webhook;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Discriminated union describing how changes are detected.
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

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Discriminated union describing what the monitor watches.
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

    public function withLastChangeAt(?\DateTimeInterface $lastChangeAt): self
    {
        $self = clone $this;
        $self['lastChangeAt'] = $lastChangeAt;

        return $self;
    }

    public function withLastRunAt(?\DateTimeInterface $lastRunAt): self
    {
        $self = clone $this;
        $self['lastRunAt'] = $lastRunAt;

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

    /**
     * @param Webhook|WebhookShape|null $webhook
     */
    public function withWebhook(Webhook|array|null $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }
}
