<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\ChangeDetection;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\Schedule;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\Status;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\Target;
use ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\Webhook;

/**
 * A page monitor using semantic change detection.
 *
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\Schedule
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\Target
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorListResponse\Data\MonitorsPageSemanticMonitor\Webhook
 *
 * @phpstan-type MonitorsPageSemanticMonitorShape = array{
 *   id: string,
 *   changeDetection: ChangeDetection|ChangeDetectionShape,
 *   createdAt: \DateTimeInterface,
 *   name: string,
 *   schedule: Schedule|ScheduleShape,
 *   status: Status|value-of<Status>,
 *   target: Target|TargetShape,
 *   updatedAt: \DateTimeInterface,
 *   lastChangeAt?: \DateTimeInterface|null,
 *   lastRunAt?: \DateTimeInterface|null,
 *   tags?: list<string>|null,
 *   webhook?: null|Webhook|WebhookShape,
 * }
 */
final class MonitorsPageSemanticMonitor implements BaseModel
{
    /** @use SdkModel<MonitorsPageSemanticMonitorShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * Detect meaning-level changes that match a natural language query.
     */
    #[Required('change_detection')]
    public ChangeDetection $changeDetection;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

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

    #[Required]
    public Target $target;

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
     * `new MonitorsPageSemanticMonitor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorsPageSemanticMonitor::with(
     *   id: ...,
     *   changeDetection: ...,
     *   createdAt: ...,
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
     * (new MonitorsPageSemanticMonitor)
     *   ->withID(...)
     *   ->withChangeDetection(...)
     *   ->withCreatedAt(...)
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
     * @param ChangeDetection|ChangeDetectionShape $changeDetection
     * @param Schedule|ScheduleShape $schedule
     * @param Status|value-of<Status> $status
     * @param Target|TargetShape $target
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        string $id,
        ChangeDetection|array $changeDetection,
        \DateTimeInterface $createdAt,
        string $name,
        Schedule|array $schedule,
        Status|string $status,
        Target|array $target,
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
     * Detect meaning-level changes that match a natural language query.
     *
     * @param ChangeDetection|ChangeDetectionShape $changeDetection
     */
    public function withChangeDetection(
        ChangeDetection|array $changeDetection
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
     * @param Target|TargetShape $target
     */
    public function withTarget(Target|array $target): self
    {
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
