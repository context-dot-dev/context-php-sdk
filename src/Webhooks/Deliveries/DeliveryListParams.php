<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Status;

/**
 * List retained batch and monitor webhook deliveries for your organization, newest first. Filter by at most one of batch_id, monitor_id, or run_id, optionally combined with status. Historical events without retained payloads are not listed. This endpoint costs no credits.
 *
 * @see ContextDev\Services\Webhooks\DeliveriesService::list()
 *
 * @phpstan-type DeliveryListParamsShape = array{
 *   batchID?: string|null,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   monitorID?: string|null,
 *   runID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   tags?: list<string>|null,
 * }
 */
final class DeliveryListParams implements BaseModel
{
    /** @use SdkModel<DeliveryListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $batchID;

    #[Optional]
    public ?string $cursor;

    #[Optional]
    public ?int $limit;

    #[Optional]
    public ?string $monitorID;

    #[Optional]
    public ?string $runID;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $batchID = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $monitorID = null,
        ?string $runID = null,
        Status|string|null $status = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        null !== $batchID && $self['batchID'] = $batchID;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $monitorID && $self['monitorID'] = $monitorID;
        null !== $runID && $self['runID'] = $runID;
        null !== $status && $self['status'] = $status;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    public function withBatchID(string $batchID): self
    {
        $self = clone $this;
        $self['batchID'] = $batchID;

        return $self;
    }

    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Optional comma-separated caller-defined tags for tracking this request. Tags are recorded on the request's usage log and can be used to filter usage on the dashboard usage page. Up to 20 tags, each 1-50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
