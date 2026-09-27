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
 * Watch a page, URL inventory, or extracted website data on a schedule. A run starts immediately to capture the baseline.
 *
 * @see ContextDev\Services\MonitorsService::create()
 *
 * @phpstan-import-type TargetVariants from \ContextDev\Monitors\MonitorCreateParams\Target
 * @phpstan-import-type ChangeDetectionVariants from \ContextDev\Monitors\MonitorCreateParams\ChangeDetection
 * @phpstan-import-type TargetShape from \ContextDev\Monitors\MonitorCreateParams\Target
 * @phpstan-import-type ChangeDetectionShape from \ContextDev\Monitors\MonitorCreateParams\ChangeDetection
 * @phpstan-import-type ScheduleShape from \ContextDev\Monitors\MonitorCreateParams\Schedule
 * @phpstan-import-type WebhookShape from \ContextDev\Monitors\MonitorCreateParams\Webhook
 *
 * @phpstan-type MonitorCreateParamsShape = array{
 *   name: string,
 *   target: TargetShape,
 *   changeDetection?: ChangeDetectionShape|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   schedule?: null|Schedule|ScheduleShape,
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
     * Display name for the monitor.
     */
    #[Required]
    public string $name;

    /**
     * What to watch: a page, a sitemap, or data extracted from a site.
     *
     * @var TargetVariants $target
     */
    #[Required(union: Target::class)]
    public MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget $target;

    /**
     * How changes are judged. Defaults to `semantic` for extract targets and page targets with `instructions`, otherwise `exact`.
     *
     * @var ChangeDetectionVariants|null $changeDetection
     */
    #[Optional('change_detection', union: ChangeDetection::class)]
    public MonitorsExactChangeDetection|MonitorsSemanticChangeDetection|null $changeDetection;

    /**
     * Always `web`. Optional.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

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
     * `new MonitorCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorCreateParams::with(name: ..., target: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorCreateParams)->withName(...)->withTarget(...)
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
     * @param TargetShape $target
     * @param ChangeDetectionShape|null $changeDetection
     * @param Mode|value-of<Mode>|null $mode
     * @param Schedule|ScheduleShape|null $schedule
     * @param list<string>|null $tags
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        string $name,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget $target,
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection|null $changeDetection = null,
        Mode|string|null $mode = null,
        Schedule|array|null $schedule = null,
        ?array $tags = null,
        Webhook|array|null $webhook = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['target'] = $target;

        null !== $changeDetection && $self['changeDetection'] = $changeDetection;
        null !== $mode && $self['mode'] = $mode;
        null !== $schedule && $self['schedule'] = $schedule;
        null !== $tags && $self['tags'] = $tags;
        null !== $webhook && $self['webhook'] = $webhook;

        return $self;
    }

    /**
     * Display name for the monitor.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
}
