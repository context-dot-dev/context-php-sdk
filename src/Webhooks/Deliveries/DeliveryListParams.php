<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Concerns\SdkParams;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Status;
use ContextDev\Webhooks\Deliveries\DeliveryListParams\Type;

/**
 * List your batch or monitor webhook deliveries, newest first.
 *
 * @see ContextDev\Services\Webhooks\DeliveriesService::list()
 *
 * @phpstan-type DeliveryListParamsShape = array{
 *   type: Type|value-of<Type>,
 *   batchID?: string|null,
 *   createdAfter?: \DateTimeInterface|null,
 *   cursor?: string|null,
 *   limit?: int|null,
 *   status?: null|Status|value-of<Status>,
 *   tags?: list<string>|null,
 *   monitorID?: string|null,
 *   runID?: string|null,
 * }
 */
final class DeliveryListParams implements BaseModel
{
    /** @use SdkModel<DeliveryListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Delivery source.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Filter by batch ID.
     */
    #[Optional('batch_id')]
    public ?string $batchID;

    /**
     * Only include events created after this ISO 8601 timestamp.
     */
    #[Optional('created_after')]
    public ?\DateTimeInterface $createdAfter;

    /**
     * The next_cursor from the previous response.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Number of deliveries to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by delivery status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @var list<string>|null $tags
     */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * Filter by monitor ID.
     */
    #[Optional('monitor_id')]
    public ?string $monitorID;

    /**
     * Filter by monitor run ID.
     */
    #[Optional('run_id')]
    public ?string $runID;

    /**
     * `new DeliveryListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliveryListParams::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeliveryListParams)->withType(...)
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
     * @param Status|value-of<Status>|null $status
     * @param list<string>|null $tags
     */
    public static function with(
        Type|string $type,
        ?string $batchID = null,
        ?\DateTimeInterface $createdAfter = null,
        ?string $cursor = null,
        ?int $limit = null,
        Status|string|null $status = null,
        ?array $tags = null,
        ?string $monitorID = null,
        ?string $runID = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $batchID && $self['batchID'] = $batchID;
        null !== $createdAfter && $self['createdAfter'] = $createdAfter;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;
        null !== $status && $self['status'] = $status;
        null !== $tags && $self['tags'] = $tags;
        null !== $monitorID && $self['monitorID'] = $monitorID;
        null !== $runID && $self['runID'] = $runID;

        return $self;
    }

    /**
     * Delivery source.
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
     * Filter by batch ID.
     */
    public function withBatchID(string $batchID): self
    {
        $self = clone $this;
        $self['batchID'] = $batchID;

        return $self;
    }

    /**
     * Only include events created after this ISO 8601 timestamp.
     */
    public function withCreatedAfter(\DateTimeInterface $createdAfter): self
    {
        $self = clone $this;
        $self['createdAfter'] = $createdAfter;

        return $self;
    }

    /**
     * The next_cursor from the previous response.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Number of deliveries to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by delivery status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Optional tags for tracking usage. Up to 20 tags, each 1 to 50 characters.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Filter by monitor ID.
     */
    public function withMonitorID(string $monitorID): self
    {
        $self = clone $this;
        $self['monitorID'] = $monitorID;

        return $self;
    }

    /**
     * Filter by monitor run ID.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }
}
