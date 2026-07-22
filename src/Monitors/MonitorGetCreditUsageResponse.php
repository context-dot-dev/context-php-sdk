<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetCreditUsageResponse\Data;

/**
 * @phpstan-import-type DataShape from \ContextDev\Monitors\MonitorGetCreditUsageResponse\Data
 *
 * @phpstan-type MonitorGetCreditUsageResponseShape = array{
 *   data: list<Data|DataShape>, totalCredits: int
 * }
 */
final class MonitorGetCreditUsageResponse implements BaseModel
{
    /** @use SdkModel<MonitorGetCreditUsageResponseShape> */
    use SdkModel;

    /** @var list<Data> $data */
    #[Required(list: Data::class)]
    public array $data;

    /**
     * Sum of credits across all monitors in the window.
     */
    #[Required('total_credits')]
    public int $totalCredits;

    /**
     * `new MonitorGetCreditUsageResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorGetCreditUsageResponse::with(data: ..., totalCredits: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorGetCreditUsageResponse)->withData(...)->withTotalCredits(...)
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
     * @param list<Data|DataShape> $data
     */
    public static function with(array $data, int $totalCredits): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['totalCredits'] = $totalCredits;

        return $self;
    }

    /**
     * @param list<Data|DataShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Sum of credits across all monitors in the window.
     */
    public function withTotalCredits(int $totalCredits): self
    {
        $self = clone $this;
        $self['totalCredits'] = $totalCredits;

        return $self;
    }
}
