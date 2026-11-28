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
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSearchTarget;
use ContextDev\Monitors\MonitorUpdateParams\Target\MonitorsSitemapTarget;
use ContextDev\Monitors\MonitorUpdateParams\Webhook;

/**
 * Change a monitor's settings, or pause and resume it. Changing the target or change detection replaces the baseline and queues a new baseline run.
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
 *   policies?: list<string>|null,
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
     * How changes are judged. Defaults to `semantic` for extract and search targets and for page targets with `instructions`; otherwise `exact`. Sitemap targets support only `exact`, and extract targets only `semantic`.
     *
     * @var ChangeDetectionVariants|null $changeDetection
     */
    #[Optional('change_detection', union: ChangeDetection::class)]
    public MonitorsExactChangeDetection|MonitorsSemanticChangeDetection|null $changeDetection;

    /**
     * Display name for the monitor.
     */
    #[Optional]
    public ?string $name;

    /**
     * Access policy IDs to apply to every run, or an empty list to remove them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
     *
     * @var list<string>|null $policies
     */
    #[Optional(list: 'string')]
    public ?array $policies;

    /**
     * Run the monitor at a fixed interval, such as every 6 hours or every 2 days. The interval must be between 10 minutes and 1 year.
     */
    #[Optional]
    public ?Schedule $schedule;

    /**
     * Set `paused` to stop scheduled runs or `active` to resume them. A resumed monitor runs promptly instead of waiting a full interval.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Labels for grouping monitors. Filter monitors, changes, and credit usage by tag.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * What to watch: a page, a sitemap, data extracted from a site, or web search results.
     *
     * @var TargetVariants|null $target
     */
    #[Optional(union: Target::class)]
    public MonitorsPageTarget|MonitorsSitemapTarget|MonitorsExtractTarget|MonitorsSearchTarget|null $target;

    /**
     * Set to `null` to remove the webhook. Changing `url` generates a new secret.
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
     * @param list<string>|null $policies
     * @param Schedule|ScheduleShape|null $schedule
     * @param Status|value-of<Status>|null $status
     * @param list<string>|null $tags
     * @param TargetShape|null $target
     * @param Webhook|WebhookShape|null $webhook
     */
    public static function with(
        MonitorsExactChangeDetection|array|MonitorsSemanticChangeDetection|null $changeDetection = null,
        ?string $name = null,
        ?array $policies = null,
        Schedule|array|null $schedule = null,
        Status|string|null $status = null,
        ?array $tags = null,
        MonitorsPageTarget|array|MonitorsSitemapTarget|MonitorsExtractTarget|MonitorsSearchTarget|null $target = null,
        Webhook|array|null $webhook = null,
    ): self {
        $self = new self;

        null !== $changeDetection && $self['changeDetection'] = $changeDetection;
        null !== $name && $self['name'] = $name;
        null !== $policies && $self['policies'] = $policies;
        null !== $schedule && $self['schedule'] = $schedule;
        null !== $status && $self['status'] = $status;
        null !== $tags && $self['tags'] = $tags;
        null !== $target && $self['target'] = $target;
        null !== $webhook && $self['webhook'] = $webhook;

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
     * Display name for the monitor.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Access policy IDs to apply to every run, or an empty list to remove them. Requires access policies enabled for your organization; otherwise returns `ACCESS_POLICIES_NOT_ENABLED`.
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
     * Set `paused` to stop scheduled runs or `active` to resume them. A resumed monitor runs promptly instead of waiting a full interval.
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
     * Set to `null` to remove the webhook. Changing `url` generates a new secret.
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
