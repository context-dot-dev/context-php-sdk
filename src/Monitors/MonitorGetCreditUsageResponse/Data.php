<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetCreditUsageResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   credits: int, monitorID: string, name: string, runs: int
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Credits charged to the monitor in the window.
     */
    #[Required]
    public int $credits;

    /**
     * ID of the monitor.
     */
    #[Required('monitor_id')]
    public string $monitorID;

    /**
     * Name of the monitor, or its ID if the monitor was deleted.
     */
    #[Required]
    public string $name;

    /**
     * Number of billed runs in the window.
     */
    #[Required]
    public int $runs;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(credits: ..., monitorID: ..., name: ..., runs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withCredits(...)->withMonitorID(...)->withName(...)->withRuns(...)
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
        int $credits,
        string $monitorID,
        string $name,
        int $runs
    ): self {
        $self = new self;

        $self['credits'] = $credits;
        $self['monitorID'] = $monitorID;
        $self['name'] = $name;
        $self['runs'] = $runs;

        return $self;
    }

    /**
     * Credits charged to the monitor in the window.
     */
    public function withCredits(int $credits): self
    {
        $self = clone $this;
        $self['credits'] = $credits;

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

    /**
     * Name of the monitor, or its ID if the monitor was deleted.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Number of billed runs in the window.
     */
    public function withRuns(int $runs): self
    {
        $self = clone $this;
        $self['runs'] = $runs;

        return $self;
    }
}
