<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetLimitsResponse\KeyMetadata;
use ContextDev\Monitors\MonitorGetLimitsResponse\Plan;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Monitors\MonitorGetLimitsResponse\KeyMetadata
 *
 * @phpstan-type MonitorGetLimitsResponseShape = array{
 *   monitorsLimit: int,
 *   monitorsUsed: int,
 *   plan: Plan|value-of<Plan>,
 *   requestID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class MonitorGetLimitsResponse implements BaseModel
{
    /** @use SdkModel<MonitorGetLimitsResponseShape> */
    use SdkModel;

    /**
     * Most monitors you can have: your plan's allowance or a custom limit.
     */
    #[Required('monitors_limit')]
    public int $monitorsLimit;

    /**
     * Number of monitors the account currently has.
     */
    #[Required('monitors_used')]
    public int $monitorsUsed;

    /**
     * `starter` means Developer; `pro` means Pro or Growth; `scale` means Scale or Enterprise.
     *
     * @var value-of<Plan> $plan
     */
    #[Required(enum: Plan::class)]
    public string $plan;

    /**
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new MonitorGetLimitsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorGetLimitsResponse::with(
     *   monitorsLimit: ..., monitorsUsed: ..., plan: ..., requestID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorGetLimitsResponse)
     *   ->withMonitorsLimit(...)
     *   ->withMonitorsUsed(...)
     *   ->withPlan(...)
     *   ->withRequestID(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        int $monitorsLimit,
        int $monitorsUsed,
        Plan|string $plan,
        string $requestID,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['monitorsLimit'] = $monitorsLimit;
        $self['monitorsUsed'] = $monitorsUsed;
        $self['plan'] = $plan;
        $self['requestID'] = $requestID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Most monitors you can have: your plan's allowance or a custom limit.
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
     * `starter` means Developer; `pro` means Pro or Growth; `scale` means Scale or Enterprise.
     *
     * @param Plan|value-of<Plan> $plan
     */
    public function withPlan(Plan|string $plan): self
    {
        $self = clone $this;
        $self['plan'] = $plan;

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
}
