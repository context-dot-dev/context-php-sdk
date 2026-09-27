<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorRunResponse\KeyMetadata;

/**
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Monitors\MonitorRunResponse\KeyMetadata
 *
 * @phpstan-type MonitorRunResponseShape = array{
 *   monitorID: string,
 *   queued: bool,
 *   requestID: string,
 *   runID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
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
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    #[Required('request_id')]
    public string $requestID;

    /**
     * ID of the queued run; pass it to Retrieve a monitor run.
     */
    #[Required('run_id')]
    public string $runID;

    /**
     * Credits this request used and your remaining balance.
     */
    #[Optional('key_metadata')]
    public ?KeyMetadata $keyMetadata;

    /**
     * `new MonitorRunResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MonitorRunResponse::with(
     *   monitorID: ..., queued: ..., requestID: ..., runID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MonitorRunResponse)
     *   ->withMonitorID(...)
     *   ->withQueued(...)
     *   ->withRequestID(...)
     *   ->withRunID(...)
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
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $monitorID,
        bool $queued,
        string $requestID,
        string $runID,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['monitorID'] = $monitorID;
        $self['queued'] = $queued;
        $self['requestID'] = $requestID;
        $self['runID'] = $runID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

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
     * Unique ID of this request, also in `X-Request-Id`. Include it when contacting support.
     */
    public function withRequestID(string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * ID of the queued run; pass it to Retrieve a monitor run.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

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
