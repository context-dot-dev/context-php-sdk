<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListRunsResponse;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListRunsResponse\Data\ChangeDetectionType;
use ContextDev\Monitors\MonitorListRunsResponse\Data\Error;
use ContextDev\Monitors\MonitorListRunsResponse\Data\RunType;
use ContextDev\Monitors\MonitorListRunsResponse\Data\Status;
use ContextDev\Monitors\MonitorListRunsResponse\Data\TargetType;

/**
 * @phpstan-import-type ErrorShape from \ContextDev\Monitors\MonitorListRunsResponse\Data\Error
 *
 * @phpstan-type DataShape = array{
 *   id: string,
 *   baselineCreated: bool,
 *   changeDetected: bool,
 *   changeDetectionType: ChangeDetectionType|value-of<ChangeDetectionType>,
 *   monitorID: string,
 *   runType: RunType|value-of<RunType>,
 *   status: Status|value-of<Status>,
 *   targetType: TargetType|value-of<TargetType>,
 *   changeID?: string|null,
 *   completedAt?: \DateTimeInterface|null,
 *   error?: null|Error|ErrorShape,
 *   startedAt?: \DateTimeInterface|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
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

    #[Required('monitor_id')]
    public string $monitorID;

    /**
     * The first run after monitor creation is a baseline run.
     *
     * @var value-of<RunType> $runType
     */
    #[Required('run_type', enum: RunType::class)]
    public string $runType;

    /** @var value-of<Status> $status */
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

    #[Optional('started_at', nullable: true)]
    public ?\DateTimeInterface $startedAt;

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
     */
    public static function with(
        string $id,
        bool $baselineCreated,
        bool $changeDetected,
        ChangeDetectionType|string $changeDetectionType,
        string $monitorID,
        RunType|string $runType,
        Status|string $status,
        TargetType|string $targetType,
        ?string $changeID = null,
        ?\DateTimeInterface $completedAt = null,
        Error|array|null $error = null,
        ?\DateTimeInterface $startedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['baselineCreated'] = $baselineCreated;
        $self['changeDetected'] = $changeDetected;
        $self['changeDetectionType'] = $changeDetectionType;
        $self['monitorID'] = $monitorID;
        $self['runType'] = $runType;
        $self['status'] = $status;
        $self['targetType'] = $targetType;

        null !== $changeID && $self['changeID'] = $changeID;
        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $error && $self['error'] = $error;
        null !== $startedAt && $self['startedAt'] = $startedAt;

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

    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    /**
     * The first run after monitor creation is a baseline run.
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

    public function withStartedAt(?\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }
}
