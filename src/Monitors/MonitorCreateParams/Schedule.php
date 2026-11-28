<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorCreateParams;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorCreateParams\Schedule\Type;
use ContextDev\Monitors\MonitorCreateParams\Schedule\Unit;

/**
 * Run the monitor at a fixed interval, such as every 6 hours or every 2 days. The interval must be between 10 minutes and 1 year.
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
     * Number of `unit` periods between runs. The interval must be between 10 minutes and 1 year, so at least `10` with `minutes` and at most `365` with `days`.
     */
    #[Required]
    public int $frequency;

    /**
     * Use `interval` to run on a repeating schedule.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Time unit for `frequency`.
     *
     * @var value-of<Unit> $unit
     */
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
     * Number of `unit` periods between runs. The interval must be between 10 minutes and 1 year, so at least `10` with `minutes` and at most `365` with `days`.
     */
    public function withFrequency(int $frequency): self
    {
        $self = clone $this;
        $self['frequency'] = $frequency;

        return $self;
    }

    /**
     * Use `interval` to run on a repeating schedule.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Time unit for `frequency`.
     *
     * @param Unit|value-of<Unit> $unit
     */
    public function withUnit(Unit|string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }
}
