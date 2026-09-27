<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetRunResponse\ChangeDetectionType;
use ContextDev\Monitors\MonitorGetRunResponse\Error;
use ContextDev\Monitors\MonitorGetRunResponse\KeyMetadata;
use ContextDev\Monitors\MonitorGetRunResponse\RunType;
use ContextDev\Monitors\MonitorGetRunResponse\SkipReason;
use ContextDev\Monitors\MonitorGetRunResponse\Status;
use ContextDev\Monitors\MonitorGetRunResponse\TargetType;

/**
 * @phpstan-import-type ErrorShape from \ContextDev\Monitors\MonitorGetRunResponse\Error
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Monitors\MonitorGetRunResponse\KeyMetadata
 * @phpstan-import-type WebhookDeliveryShape from \ContextDev\Monitors\WebhookDelivery
 *
 * @phpstan-type MonitorGetRunResponseShape = array{
 *   id: string,
 *   baselineCreated: bool,
 *   changeDetected: bool,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   creditsCharged: int,
 *   monitorID: string,
 *   requestID: string,
 *   runType: RunType|value-of<RunType>,
 *   status: Status|value-of<Status>,
 *   targetType: TargetType|value-of<TargetType>,
 *   changeID?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   error?: null|Error|ErrorShape,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 *   skipReason?: null|SkipReason|value-of<SkipReason>,
 *   startedAt?: \DateTimeInterface|null,
 *   webhookDeliveries?: list<WebhookDelivery|WebhookDeliveryShape>|null,
 *   webhookDelivery?: null|WebhookDelivery|WebhookDeliveryShape,
 *   webhookDeliveryIDs?: list<string>|null,
 * }
 */
final class MonitorGetRunResponse implements BaseModel
{
    /** @use SdkModel<MonitorGetRunResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * True when this run established the monitor's initial baseline; baseline runs perform no change detection.
     */
    #[Required('baseline_created')]
    public bool $baselineCreated;

    #[Required('change_detected')]
    public bool $changeDetected;

    /** @var value-of<ChangeDetectionType> $changeDetectionType */
    #[Required('change_detection_type', enum: ChangeDetectionType::class)]
    public string $changeDetectionType;

    /**
     * Credits charged for this run (0 for skipped/failed runs).
     */
    #[Required('credits_charged')]
    public int $creditsCharged;

    #[Required('monitor_id')]
    public string $monitorID;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * A baseline run follows creation or a target or detection change.
     *
     * @var value-of<RunType> $runType
     */
    #[Required('run_type', enum: RunType::class)]
    public string $runType;

    /**
     * Lifecycle status of a run. `skipped` runs never executed — see `skip_reason` (insufficient credits, monitor paused, or superseded by a concurrent run).
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /** @var value-of<TargetType> $targetType */
    #[Required('target_type', enum: TargetType::class)]
    public string $targetType;

    #[Optional('change_id', nullable: true)]
    public ?string $changeID;

    #[Optional('completed_at', nullable: true)]
    public ?\DateTimeInterface $completedAt;

    #[Optional(nullable: true)]
    public ?Error $error;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * Why a skipped run never executed; null unless status is `skipped`.
     *
     * @var value-of<SkipReason>|null $skipReason
     */
    #[Optional('skip_reason', enum: SkipReason::class, nullable: true)]
    public ?string $skipReason;

    #[Optional('started_at', nullable: true)]
    public ?\DateTimeInterface $startedAt;

    /**
     * All webhook deliveries attempted by this run — one per subscribed event that fired. Omitted when no webhook was attempted, including runs created before event selection was added.
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
     * Webhook delivery IDs for this run.
     *
     * @var list<string>|null $webhookDeliveryIDs
     */
    #[Optional('webhook_delivery_ids', list: 'string')]
    public ?array $webhookDeliveryIDs;

    /**
     * `new MonitorGetRunResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorGetRunResponse::with(
     *   id: ...,
     *   baselineCreated: ...,
     *   changeDetected: ...,
     *   changeDetectionType: ...,
     *   creditsCharged: ...,
     *   monitorID: ...,
     *   requestID: ...,
     *   runType: ...,
     *   status: ...,
     *   targetType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorGetRunResponse)
     *   ->withID(...)
     *   ->withBaselineCreated(...)
     *   ->withChangeDetected(...)
     *   ->withChangeDetectionType(...)
     *   ->withCreditsCharged(...)
     *   ->withMonitorID(...)
     *   ->withRequestID(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
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
        string $requestID,
        RunType|string $runType,
        Status|string $status,
        TargetType|string $targetType,
        ?string $changeID = null,
        ?\DateTimeInterface $completedAt = null,
        Error|array|null $error = null,
        KeyMetadata|array|null $keyMetadata = null,
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
        $self['requestID'] = $requestID;
        $self['runType'] = $runType;
        $self['status'] = $status;
        $self['targetType'] = $targetType;

        null !== $changeID && $self['changeID'] = $changeID;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $error && $self['error'] = $error;
        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;
        null !== $skipReason && $self['skipReason'] = $skipReason;
        null !== $startedAt && $self['startedAt'] = $startedAt;
        null !== $webhookDeliveries && $self['webhookDeliveries'] = $webhookDeliveries;
        null !== $webhookDelivery && $self['webhookDelivery'] = $webhookDelivery;
        null !== $webhookDeliveryIDs && $self['webhookDeliveryIDs'] = $webhookDeliveryIDs;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * True when this run established the monitor's initial baseline; baseline runs perform no change detection.
     */
    public function withBaselineCreated(bool $baselineCreated): self
    {
        $self = clone $this;
        $self['baselineCreated'] = $baselineCreated;

        return $self;
    }

    public function withChangeDetected(bool $changeDetected): self
    {
        $self = clone $this;
        $self['changeDetected'] = $changeDetected;

        return $self;
    }

    /**
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
     * Credits charged for this run (0 for skipped/failed runs).
     */
    public function withCreditsCharged(int $creditsCharged): self
    {
        $self = clone $this;
        $self['creditsCharged'] = $creditsCharged;

        return $self;
    }

    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

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
     * A baseline run follows creation or a target or detection change.
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
     * Lifecycle status of a run. `skipped` runs never executed — see `skip_reason` (insufficient credits, monitor paused, or superseded by a concurrent run).
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
     * @param TargetType|value-of<TargetType> $targetType
     */
    public function withTargetType(TargetType|string $targetType): self
    {
        $self = clone $this;
        $self['targetType'] = $targetType;

        return $self;
    }

    public function withChangeID(?string $changeID): self
    {
        $self = clone $this;
        $self['changeID'] = $changeID;

        return $self;
    }

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

    /**
     * Why a skipped run never executed; null unless status is `skipped`.
     *
     * @param SkipReason|value-of<SkipReason>|null $skipReason
     */
    public function withSkipReason(SkipReason|string|null $skipReason): self
    {
        $self = clone $this;
        $self['skipReason'] = $skipReason;

        return $self;
    }

    public function withStartedAt(?\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * All webhook deliveries attempted by this run — one per subscribed event that fired. Omitted when no webhook was attempted, including runs created before event selection was added.
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
     * Webhook delivery IDs for this run.
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
