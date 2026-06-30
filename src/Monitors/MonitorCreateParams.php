<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection\MonitorsExactChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\ChangeDetection\MonitorsSemanticChangeDetection;
use ContextDev\Monitors\MonitorCreateParams\Mode;
use ContextDev\Monitors\MonitorCreateParams\Schedule;
use ContextDev\Monitors\MonitorCreateParams\Target;
use ContextDev\Monitors\MonitorCreateParams\Target\MonitorsExtractTarget;
use ContextDev\Monitors\MonitorCreateParams\Target\MonitorsPageTarget;
use ContextDev\Monitors\MonitorCreateParams\Target\MonitorsSitemapTarget;
use ContextDev\Monitors\MonitorCreateParams\Webhook;

/**
 * Creates a monitor. The request body is a union of the supported target/change detection combinations. The monitor runs immediately after creation to create its initial baseline.
 *
 * @see ContextDev\Services\MonitorsService::create()
 *
 * @phpstan-import-type ChangeDetectionVariants from \ContextDev\Monitors\MonitorCreateParams\ChangeDetection
 * @phpstan-import-type TargetVariants from \ContextDev\Monitors\MonitorCreateParams\Target
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorCreateParams\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorCreateParams\Schedule
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorCreateParams\Target
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorCreateParams\Webhook
 *
 * @phpstan-type MonitorCreateParamsShape = array{
 *   changeDetection: ChangeDetectionShape,
 *   name: string,
 *   schedule: Schedule|ScheduleShape,
 *   target: TargetShape,
 *   mode?: null|Mode|value-of<Mode>,
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
     * Discriminated union describing how changes are detected.
     *
     * @var ChangeDetectionVariants $changeDetection
     */
    #[Required('change_detection', union: ChangeDetection::class)]
    public MonitorsExactChangeDetection|MonitorsSemanticChangeDetection $changeDetection;

    #[Required]
    public string $name;

    /**
     * Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
     */
    #[Required]
    public Schedule $schedule;

    /**
     * Discriminated union describing what the monitor watches.
     *
     * @var TargetVariants $target
     */
    #[Required(union: Target::class)]
    public MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget $target;

    /**
     * Top-level monitor category. Always `web` today; the concrete behavior is described by `target` and `change_detection`.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

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
     * @param ChangeDetectionShape $changeDetection
     * @param Schedule|ScheduleShape $schedule
     * @param TargetShape $target
     * @param Mode|value-of<Mode>|null $mode
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection $changeDetection,
        string $name,
        Schedule|array $schedule,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget $target,
        Mode|string|null $mode = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
    ): self {
        $self = new self;

        $self['changeDetection'] = $changeDetection;
        $self['name'] = $name;
        $self['schedule'] = $schedule;
        $self['target'] = $target;

        null !== $mode && $self['mode'] = $mode;
        null !== $tags && $self['tags'] = $tags;
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
