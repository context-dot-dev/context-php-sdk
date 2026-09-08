<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Delivery\Source;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\Delivery\Source\Monitor\Type;

/**
 * @phpstan-type MonitorShape = array{
 *   monitorID: string, runID: string, type: Type|value-of<Type>
 * }
 */
final class Monitor implements BaseModel
{
    /** @use SdkModel<MonitorShape> */
    use SdkModel;

    /**
     * Monitor ID.
     */
    #[Required('monitor_id')]
    public string $monitorID;

    /**
     * Monitor run ID.
     */
    #[Required('run_id')]
    public string $runID;

    /**
     * Delivery source.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Monitor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Monitor::with(monitorID: ..., runID: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Monitor)->withMonitorID(...)->withRunID(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $monitorID,
        string $runID,
        Type|string $type
    ): self {
        $self = new self;

        $self['monitorID'] = $monitorID;
        $self['runID'] = $runID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Monitor ID.
     */
    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    /**
     * Monitor run ID.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }

    /**
     * Delivery source.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
