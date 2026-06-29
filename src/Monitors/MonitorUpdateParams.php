<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorUpdateParams\ChangeDetection;
use ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorUpdateParams\ChangeDetection\MonitorsSemanticChangeDetection;
use ContextDev\Monitors\MonitorUpdateParams\Schedule;
use ContextDev\Monitors\MonitorUpdateParams\Status;
use ContextDev\Monitors\MonitorUpdateParams\Target;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSitemapTarget;
use ContextDev\Monitors\MonitorUpdateParams\Webhook;

/**
 * Updates a monitor. If `target` or `change_detection` changes, the monitor creates a new baseline. Unsupported target/change detection combinations are rejected.
 *
 * @see ContextDev\Services\MonitorsService::update()
 *
 * @phpstan-import-type ChangeDetectionVariants from \ContextDev\Monitors\MonitorUpdateParams\ChangeDetection
 * @phpstan-import-type TargetVariants from \ContextDev\Monitors\MonitorUpdateParams\Target
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorUpdateParams\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorUpdateParams\Schedule
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorUpdateParams\Target
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorUpdateParams\Webhook
 *
 * @phpstan-type MonitorUpdateParamsShape = array{
 *   changeDetection?: ChangeDetectionShape|null,
 *   name?: string|null,
 *   schedule?: null|Schedule|ScheduleShape,
 *   status?: null|Status|value-of<Status>,
 *   tags?: list<string>|null,
 *   target?: TargetShape|null,
 *   webhook?: null|Webhook|WebhookShape,
 * }
 */
final class MonitorUpdateParams implements BaseModel
{
    /** @use SdkModel<MonitorUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Discriminated union describing how changes are detected.
     *
     * @var ChangeDetectionVariants|null $changeDetection
     */
    #[Optional('change_detection', union: ChangeDetection::class)]
    public MonitorsExactChangeDetection|MonitorsSemanticChangeDetection|null $changeDetection;

    #[Optional]
    public ?string $name;

    /**
     * Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     */
    #[Optional]
    public ?Schedule $schedule;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * User-defined tags for grouping and filtering monitors and their changes.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Discriminated union describing what the monitor watches.
     *
     * @var TargetVariants|null $target
     */
    #[Optional(union: Target::class)]
    public MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget|null $target;

    /**
     * Set to null to remove the webhook.
     */
    #[Optional(nullable: true)]
    public ?Webhook $webhook;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ChangeDetectionShape|null $changeDetection
     * @param Schedule|ScheduleShape|null $schedule
     * @param Status|value-of<Status>|null $status
     * @param list<string>|null $tags
     * @param TargetShape|null $target
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection|null $changeDetection = null,
        ?string $name = null,
        Schedule|array|null $schedule = null,
        Status|string|null $status = null,
        ?array $tags = null,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget|null $target = null,
        Webhook|array|null $webhook = null,
    ): self {
        $self = new self;

        null !== $changeDetection && $self['changeDetection'] = $changeDetection;
        null !== $name && $self['name'] = $name;
        null !== $schedule && $self['schedule'] = $schedule;
        null !== $status && $self['status'] = $status;
        null !== $tags && $self['tags'] = $tags;
        null !== $target && $self['target'] = $target;
        null !== $webhook && $self['webhook'] = $webhook;

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

    /**
     * Set to null to remove the webhook.
     *
     * @param Webhook|WebhookShape|null $webhook
     */
    public function withWebhook(Webhook|array|null $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }
}
