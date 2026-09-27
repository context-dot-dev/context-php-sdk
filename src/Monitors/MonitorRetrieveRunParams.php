<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Retrieve the status, timing, and results of one monitor run.
 *
 * @see ContextDev\Services\MonitorsService::retrieveRun()
 *
 * @phpstan-type MonitorRetrieveRunParamsShape = array{monitorID: string}
 */
final class MonitorRetrieveRunParams implements BaseModel
{
    /** @use SdkModel<MonitorRetrieveRunParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ID of the monitor.
     */
    #[Required]
    public string $monitorID;

    /**
     * `new MonitorRetrieveRunParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorRetrieveRunParams::with(monitorID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorRetrieveRunParams)->withMonitorID(...)
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
    public static function with(string $monitorID): self
    {
        $self = new self;

        $self['monitorID'] = $monitorID;

        return $self;
    }

    /**
     * ID of the monitor.
     */
    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }
}
