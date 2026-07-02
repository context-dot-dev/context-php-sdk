<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type MonitorRunResponseShape = array{
 *   monitorID: string, queued: bool, runID: string
 * }
 */
final class MonitorRunResponse implements BaseModel
{
    /** @use SdkModel<MonitorRunResponseShape> */
    use SdkModel;

    #[Required('monitor_id')]
    public string $monitorID;

    #[Required]
    public bool $queued;

    /**
     * The queued run. Poll GET /monitors/{monitor_id}/runs or use it to correlate results.
     */
    #[Required('run_id')]
    public string $runID;

    /**
     * `new MonitorRunResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorRunResponse::with(monitorID: ..., queued: ..., runID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorRunResponse)->withMonitorID(...)->withQueued(...)->withRunID(...)
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
     */
    public static function with(
        string $monitorID,
        bool $queued,
        string $runID
    ): self {
        $self = new self;

        $self['monitorID'] = $monitorID;
        $self['queued'] = $queued;
        $self['runID'] = $runID;

        return $self;
    }

    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    public function withQueued(bool $queued): self
    {
        $self = clone $this;
        $self['queued'] = $queued;

        return $self;
    }

    /**
     * The queued run. Poll GET /monitors/{monitor_id}/runs or use it to correlate results.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }
}
