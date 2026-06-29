<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor\Schedule\Type;
use ContextDev\Monitors\MonitorGetResponse\MonitorsPageSemanticMonitor\Schedule\Unit;

/**
 * Run the monitor on a fixed interval defined by a frequency and a unit, e.g. every 6 hours or every 2 days. The total interval (frequency × unit) must be between 10 minutes and 1 year.
 *
 * @phpstan-type ScheduleShape = array{
 *   frequency: int, type: Type|value-of<Type>, unit: Unit|value-of<Unit>
 * }
 */
final class Schedule implements BaseModel
{
    /** @use SdkModel<ScheduleShape> */
    use SdkModel;

    /**
     * Number of units between runs. The resulting interval (frequency × unit) must be at least 10 minutes and at most 1 year (e.g. minimum 10 when unit is minutes; maximum 365 when unit is days).
     */
    #[Required]
    public int $frequency;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    /** @var value-of<Unit> $unit */
    #[Required(enum: Unit::class)]
    public string $unit;

    /**
     * `new Schedule()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Schedule::with(frequency: ..., type: ..., unit: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Schedule)->withFrequency(...)->withType(...)->withUnit(...)
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
     * @param Unit|value-of<Unit> $unit
     */
    public static function with(
        int $frequency,
        Type|string $type,
        Unit|string $unit
    ): self {
        $self = new self;

        $self['frequency'] = $frequency;
        $self['type'] = $type;
        $self['unit'] = $unit;

        return $self;
    }

    /**
     * Number of units between runs. The resulting interval (frequency × unit) must be at least 10 minutes and at most 1 year (e.g. minimum 10 when unit is minutes; maximum 365 when unit is days).
     */
    public function withFrequency(int $frequency): self
    {
        $self = clone $this;
        $self['frequency'] = $frequency;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * @param Unit|value-of<Unit> $unit
     */
    public function withUnit(Unit|string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }
}
