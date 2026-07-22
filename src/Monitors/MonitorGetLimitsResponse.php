<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetLimitsResponse\Plan;

/**
 * @phpstan-type MonitorGetLimitsResponseShape = array{
 *   monitorsLimit: int, monitorsUsed: int, plan: Plan|value-of<Plan>
 * }
 */
final class MonitorGetLimitsResponse implements BaseModel
{
    /** @use SdkModel<MonitorGetLimitsResponseShape> */
    use SdkModel;

    /**
     * Maximum number of monitors allowed for the account. Defaults to the plan allowance unless a custom limit is set for the organization.
     */
    #[Required('monitors_limit')]
    public int $monitorsLimit;

    /**
     * Number of monitors the account currently has.
     */
    #[Required('monitors_used')]
    public int $monitorsUsed;

    /**
     * The plan tier the limit was resolved from.
     *
     * @var value-of<Plan> $plan
     */
    #[Required(enum: Plan::class)]
    public string $plan;

    /**
     * `new MonitorGetLimitsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorGetLimitsResponse::with(monitorsLimit: ..., monitorsUsed: ..., plan: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorGetLimitsResponse)
     *   ->withMonitorsLimit(...)
     *   ->withMonitorsUsed(...)
     *   ->withPlan(...)
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
     * @param Plan|value-of<Plan> $plan
     */
    public static function with(
        int $monitorsLimit,
        int $monitorsUsed,
        Plan|string $plan
    ): self {
        $self = new self;

        $self['monitorsLimit'] = $monitorsLimit;
        $self['monitorsUsed'] = $monitorsUsed;
        $self['plan'] = $plan;

        return $self;
    }

    /**
     * Maximum number of monitors allowed for the account. Defaults to the plan allowance unless a custom limit is set for the organization.
     */
    public function withMonitorsLimit(int $monitorsLimit): self
    {
        $self = clone $this;
        $self['monitorsLimit'] = $monitorsLimit;

        return $self;
    }

    /**
     * Number of monitors the account currently has.
     */
    public function withMonitorsUsed(int $monitorsUsed): self
    {
        $self = clone $this;
        $self['monitorsUsed'] = $monitorsUsed;

        return $self;
    }

    /**
     * The plan tier the limit was resolved from.
     *
     * @param Plan|value-of<Plan> $plan
     */
    public function withPlan(Plan|string $plan): self
    {
        $self = clone $this;
        $self['plan'] = $plan;

        return $self;
    }
}
