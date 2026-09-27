<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorGetCreditUsageResponse\Data;
use ContextDev\Monitors\MonitorGetCreditUsageResponse\KeyMetadata;

/**
 * @phpstan-import-type DataShape from \ContextDev\Monitors\MonitorGetCreditUsageResponse\Data
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Monitors\MonitorGetCreditUsageResponse\KeyMetadata
 *
 * @phpstan-type MonitorGetCreditUsageResponseShape = array{
 *   data: list<Data|DataShape>,
 *   requestID: string,
 *   totalCredits: int,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
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
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * Sum of credits across all monitors in the window.
     */
    #[Required('total_credits')]
    public int $totalCredits;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new MonitorGetCreditUsageResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorGetCreditUsageResponse::with(
     *   data: ..., requestID: ..., totalCredits: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorGetCreditUsageResponse)
     *   ->withData(...)
     *   ->withRequestID(...)
     *   ->withTotalCredits(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        array $data,
        string $requestID,
        int $totalCredits,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['requestID'] = $requestID;
        $self['totalCredits'] = $totalCredits;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

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
