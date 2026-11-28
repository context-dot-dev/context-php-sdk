<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListAccountRunsResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListAccountRunsResponse\Data\ChangeDetectionType;
use ContextDev\Monitors\MonitorListAccountRunsResponse\Data\Error;
use ContextDev\Monitors\MonitorListAccountRunsResponse\Data\RunType;
use ContextDev\Monitors\MonitorListAccountRunsResponse\Data\SkipReason;
use ContextDev\Monitors\MonitorListAccountRunsResponse\Data\Status;
use ContextDev\Monitors\MonitorListAccountRunsResponse\Data\TargetType;
use ContextDev\Monitors\WebhookDelivery;

/**
 * @phpstan-import-type ErrorShape from \ContextDev\Monitors\MonitorListAccountRunsResponse\Data\Error
 * @phpstan-import-type WebhookDeliveryShape from \ContextDev\Monitors\WebhookDelivery
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   baselineCreated: bool,
 *   changeDetected: bool,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   creditsCharged: int,
 *   monitorID: string,
 *   runType: RunType|value-of<RunType>,
 *   status: Status|value-of<Status>,
 *   targetType: TargetType|value-of<TargetType>,
 *   changeID?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   error?: null|Error|ErrorShape,
 *   skipReason?: null|SkipReason|value-of<SkipReason>,
 *   startedAt?: \DateTimeInterface|null,
 *   webhookDeliveries?: list<WebhookDelivery|WebhookDeliveryShape>|null,
 *   webhookDelivery?: null|WebhookDelivery|WebhookDeliveryShape,
 *   webhookDeliveryIDs?: list<string>|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Unique ID of the run.
     */
    #[Required]
    public string $id;

    /**
     * `true` when this run captured the monitor's baseline instead of checking for changes.
     */
    #[Required('baseline_created')]
    public bool $baselineCreated;

    /**
     * Whether the run detected a change.
     */
    #[Required('change_detected')]
    public bool $changeDetected;

    /**
     * Change detection type the monitor uses.
     *
     * @var value-of<ChangeDetectionType> $changeDetectionType
     */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    /**
     * Credits charged for this run. `0` for skipped and failed runs.
     */
    #[Required('credits_charged')]
    public int $creditsCharged;

    /**
     * ID of the monitor this run belongs to.
     */
    #[Required('monitor_id')]
    public string $monitorID;

    /**
     * `baseline` runs capture a fresh baseline after creation or a target or detection change. `scheduled` runs, including on-demand ones, check for changes.
     *
     * @var value-of<RunType> $runType
     */
    #[Required('run_type', enum: RunType::class)]
    public string $runType;

    /**
     * Run status. `skipped` runs never executed; `skip_reason` says why.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Type of target the monitor watches.
     *
     * @var value-of<TargetType> $targetType
     */
    #[Required('target_type', enum: TargetType::class)]
    public string $targetType;

    /**
     * ID of the change this run detected. `null` when it found none.
     */
    #[Optional('change_id', nullable: true)]
    public ?string $changeID;

    /**
     * When the run ended. `null` until it ends.
     */
    #[Optional('completed_at', nullable: true)]
    public ?\DateTimeInterface $completedAt;

    #[Optional(nullable: true)]
    public ?Error $error;

    /**
     * Why the run was skipped; `superseded` means a concurrent run took its place or the monitor was deleted. `null` unless `status` is `skipped`.
     *
     * @var value-of<SkipReason>|null $skipReason
     */
    #[Optional('skip_reason', enum: SkipReason::class, nullable: true)]
    public ?string $skipReason;

    /**
     * When the run started. `null` until it starts.
     */
    #[Optional('started_at', nullable: true)]
    public ?\DateTimeInterface $startedAt;

    /**
     * Webhook deliveries for this run, one per subscribed event that fired. Omitted when no delivery was attempted.
     *
     * @var list<WebhookDelivery>|null $webhookDeliveries
     */
    #[Optional('webhook_deliveries', list: WebhookDelivery::class)]
    public ?array $webhookDeliveries;

    /**
     * @deprecated
     *
     * Deprecated. Use `webhook_deliveries` for all attempts.
     */
    #[Optional('webhook_delivery')]
    public ?WebhookDelivery $webhookDelivery;

    /**
     * IDs of the webhook deliveries sent for this run.
     *
     * @var list<string>|null $webhookDeliveryIDs
     */
    #[Optional('webhook_delivery_ids', list: 'string')]
    public ?array $webhookDeliveryIDs;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   baselineCreated: ...,
     *   changeDetected: ...,
     *   changeDetectionType: ...,
     *   creditsCharged: ...,
     *   monitorID: ...,
     *   runType: ...,
     *   status: ...,
     *   targetType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withID(...)
     *   ->withBaselineCreated(...)
     *   ->withChangeDetected(...)
     *   ->withChangeDetectionType(...)
     *   ->withCreditsCharged(...)
     *   ->withMonitorID(...)
     *   ->withRunType(...)
     *   ->withStatus(...)
     *   ->withTargetType(...)
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
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     * @param RunType|value-of<RunType> $runType
     * @param Status|value-of<Status> $status
     * @param TargetType|value-of<TargetType> $targetType
     * @param Error|ErrorShape|null $error
     * @param SkipReason|value-of<SkipReason>|null $skipReason
     * @param list<WebhookDelivery|WebhookDeliveryShape>|null $webhookDeliveries
     * @param WebhookDelivery|WebhookDeliveryShape|null $webhookDelivery
     * @param list<string>|null $webhookDeliveryIDs
     */
    public static function with(
        string $id,
        bool $baselineCreated,
        bool $changeDetected,
        ChangeDetectionType|string $changeDetectionType,
        int $creditsCharged,
        string $monitorID,
        RunType|string $runType,
        Status|string $status,
        TargetType|string $targetType,
        ?string $changeID = null,
        ?\DateTimeInterface $completedAt = null,
        Error|array|null $error = null,
        SkipReason|string|null $skipReason = null,
        ?\DateTimeInterface $startedAt = null,
        ?array $webhookDeliveries = null,
        WebhookDelivery|array|null $webhookDelivery = null,
        ?array $webhookDeliveryIDs = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['baselineCreated'] = $baselineCreated;
        $self['changeDetected'] = $changeDetected;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['creditsCharged'] = $creditsCharged;
        $self['monitorID'] = $monitorID;
        $self['runType'] = $runType;
        $self['status'] = $status;
        $self['targetType'] = $targetType;

        null !== $changeID && $self['changeID'] = $changeID;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $error && $self['error'] = $error;
        null !== $skipReason && $self['skipReason'] = $skipReason;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $webhookDeliveries && $self['webhookDeliveries'] = $webhookDeliveries;
        null !== $webhookDelivery && $self['webhookDelivery'] = $webhookDelivery;
        null !== $webhookDeliveryIDs && $self['webhookDeliveryIDs'] = $webhookDeliveryIDs;

        return $self;
    }

    /**
     * Unique ID of the run.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * `true` when this run captured the monitor's baseline instead of checking for changes.
     */
    public function withBaselineCreated(bool $baselineCreated): self
    {
        $self = clone $this;
        $self['baselineCreated'] = $baselineCreated;

        return $self;
    }

    /**
     * Whether the run detected a change.
     */
    public function withChangeDetected(bool $changeDetected): self
    {
        $self = clone $this;
        $self['changeDetected'] = $changeDetected;

        return $self;
    }

    /**
     * Change detection type the monitor uses.
     *
     * @param ChangeDetectionType|value-of<ChangeDetectionType> $changeDetectionType
     */
    public function withChangeDetectionType(
        ChangeDetectionType|string $changeDetectionType
    ): self {
        $self = clone $this;
        $self['changeDetectionType'] = $changeDetectionType;

        return $self;
    }

    /**
     * Credits charged for this run. `0` for skipped and failed runs.
     */
    public function withCreditsCharged(int $creditsCharged): self
    {
        $self = clone $this;
        $self['creditsCharged'] = $creditsCharged;

        return $self;
    }

    /**
     * ID of the monitor this run belongs to.
     */
    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    /**
     * `baseline` runs capture a fresh baseline after creation or a target or detection change. `scheduled` runs, including on-demand ones, check for changes.
     *
     * @param RunType|value-of<RunType> $runType
     */
    public function withRunType(RunType|string $runType): self
    {
        $self = clone $this;
        $self['runType'] = $runType;

        return $self;
    }

    /**
     * Run status. `skipped` runs never executed; `skip_reason` says why.
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
     * Type of target the monitor watches.
     *
     * @param TargetType|value-of<TargetType> $targetType
     */
    public function withTargetType(TargetType|string $targetType): self
    {
        $self = clone $this;
        $self['targetType'] = $targetType;

        return $self;
    }

    /**
     * ID of the change this run detected. `null` when it found none.
     */
    public function withChangeID(?string $changeID): self
    {
        $self = clone $this;
        $self['changeID'] = $changeID;

        return $self;
    }

    /**
     * When the run ended. `null` until it ends.
     */
    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * @param Error|ErrorShape|null $error
     */
    public function withError(Error|array|null $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Why the run was skipped; `superseded` means a concurrent run took its place or the monitor was deleted. `null` unless `status` is `skipped`.
     *
     * @param SkipReason|value-of<SkipReason>|null $skipReason
     */
    public function withSkipReason(SkipReason|string|null $skipReason): self
    {
        $self = clone $this;
        $self['skipReason'] = $skipReason;

        return $self;
    }

    /**
     * When the run started. `null` until it starts.
     */
    public function withStartedAt(?\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * Webhook deliveries for this run, one per subscribed event that fired. Omitted when no delivery was attempted.
     *
     * @param list<WebhookDelivery|WebhookDeliveryShape> $webhookDeliveries
     */
    public function withWebhookDeliveries(array $webhookDeliveries): self
    {
        $self = clone $this;
        $self['webhookDeliveries'] = $webhookDeliveries;

        return $self;
    }

    /**
     * Deprecated. Use `webhook_deliveries` for all attempts.
     *
     * @param WebhookDelivery|WebhookDeliveryShape $webhookDelivery
     */
    public function withWebhookDelivery(
        WebhookDelivery|array $webhookDelivery
    ): self {
        $self = clone $this;
        $self['webhookDelivery'] = $webhookDelivery;

        return $self;
    }

    /**
     * IDs of the webhook deliveries sent for this run.
     *
     * @param list<string> $webhookDeliveryIDs
     */
    public function withWebhookDeliveryIDs(array $webhookDeliveryIDs): self
    {
        $self = clone $this;
        $self['webhookDeliveryIDs'] = $webhookDeliveryIDs;

        return $self;
    }
}
