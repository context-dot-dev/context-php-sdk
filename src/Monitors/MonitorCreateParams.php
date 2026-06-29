<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\Schedule;
use ContextDev\Monitors\MonitorCreateParams\Target;
use ContextDev\Monitors\MonitorCreateParams\Webhook;

/**
 * Creates a monitor. The request body is a union of the supported target/change detection combinations. The monitor runs immediately after creation to create its initial baseline.
 *
 * @see ContextDev\Services\MonitorsService::create()
 *
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorCreateParams\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorCreateParams\Schedule
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorCreateParams\Target
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorCreateParams\Webhook
 *
 * @phpstan-type MonitorCreateParamsShape = array{
 *   changeDetection: ChangeDetection|ChangeDetectionShape,
 *   name: string,
 *   schedule: Schedule|ScheduleShape,
 *   target: Target|TargetShape,
 *   tags?: list<string>|null,
 *   webhook?: null|Webhook|WebhookShape,
 * }
 */
final class MonitorCreateParams implements BaseModel
{
    /** @use SdkModel<MonitorCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Detect meaning-level changes that match a natural language query.
     */
    #[Required('change_detection')]
    public ChangeDetection $changeDetection;

    #[Required]
    public string $name;

    /**
     * Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     */
    #[Required]
    public Schedule $schedule;

    #[Required]
    public Target $target;

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
     * `new MonitorCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorCreateParams::with(
     *   changeDetection: ..., name: ..., schedule: ..., target: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorCreateParams)
     *   ->withChangeDetection(...)
     *   ->withName(...)
     *   ->withSchedule(...)
     *   ->withTarget(...)
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
     * @param Target|TargetShape $target
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        ChangeDetection|array $changeDetection,
        string $name,
        Schedule|array $schedule,
        Target|array $target,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
    ): self {
        $self = new self;

        $self['changeDetection'] = $changeDetection;
        $self['name'] = $name;
        $self['schedule'] = $schedule;
        $self['target'] = $target;

        null !== $tags && $self['tags'] = $tags;
        null !== $webhook && $self['webhook'] = $webhook;

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
     * @param Target|TargetShape $target
     */
    public function withTarget(Target|array $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

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
