<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\Delivery\Event;
use ContextDev\Webhooks\Deliveries\Delivery\LastError;
use ContextDev\Webhooks\Deliveries\Delivery\Source\Batch;
use ContextDev\Webhooks\Deliveries\Delivery\Source\Monitor;
use ContextDev\Webhooks\Deliveries\Delivery\Status;
use ContextDev\Webhooks\Deliveries\DeliveryGetResponse\KeyMetadata;
use ContextDev\Webhooks\RetryConfig;

/**
 * @phpstan-import-type SourceVariants from \ContextDev\Webhooks\Deliveries\Delivery\Source
 * @phpstan-import-type AttemptShape from \ContextDev\Webhooks\Deliveries\Attempt
 * @phpstan-import-type LastErrorShape from \ContextDev\Webhooks\Deliveries\Delivery\LastError
 * @phpstan-import-type RetryConfigShape from \ContextDev\Webhooks\RetryConfig
 * @phpstan-import-type SourceShape from \ContextDev\Webhooks\Deliveries\Delivery\Source
 * @phpstan-import-type KeyMetadataShape from \ContextDev\Webhooks\Deliveries\DeliveryGetResponse\KeyMetadata
 *
 * @phpstan-type DeliveryGetResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   deliveredAt: \DateTimeInterface|null,
 *   event: Event|value-of<Event>,
 *   eventID: string,
 *   lastAttempt: Attempt|AttemptShape,
 *   lastError: null|LastError|LastErrorShape,
 *   nextAttemptAt: \DateTimeInterface|null,
 *   retry: RetryConfig|RetryConfigShape,
 *   retryExpiresAt: \DateTimeInterface,
 *   source: SourceShape,
 *   status: Status|value-of<Status>,
 *   url: string,
 *   requestID: string,
 *   keyMetadata?: null|KeyMetadata|KeyMetadataShape,
 * }
 */
final class DeliveryGetResponse implements BaseModel
{
    /** @use SdkModel<DeliveryGetResponseShape> */
    use SdkModel;

    /**
     * Unique ID of the delivery.
     */
    #[Required]
    public string $id;

    /**
     * When the event was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * When the delivery last succeeded. `null` until it succeeds.
     */
    #[Required('delivered_at')]
    public ?\DateTimeInterface $deliveredAt;

    /**
     * Event that triggered the delivery.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * Event ID, sent as `X-Context-Id` and as `id` in the payload. It stays the same across retries, so use it to deduplicate.
     */
    #[Required('event_id')]
    public string $eventID;

    #[Required('last_attempt')]
    public Attempt $lastAttempt;

    /**
     * Most recent delivery error. `null` when there is none.
     */
    #[Required('last_error')]
    public ?LastError $lastError;

    /**
     * When the next attempt is scheduled. `null` when none is scheduled.
     */
    #[Required('next_attempt_at')]
    public ?\DateTimeInterface $nextAttemptAt;

    /**
     * Automatic retry settings. Pass `{}` for the default schedule.
     */
    #[Required]
    public RetryConfig $retry;

    /**
     * Last time you can retry the delivery manually, 7 days after the event.
     */
    #[Required('retry_expires_at')]
    public \DateTimeInterface $retryExpiresAt;

    /**
     * Batch or monitor run that produced the event.
     *
     * @var SourceVariants $source
     */
    #[Required]
    public Batch|Monitor $source;

    /**
     * Delivery state. `pending` is waiting for an attempt, `delivering` has an attempt in progress, `retrying` is waiting for an automatic retry, `delivered` was acknowledged with a 2xx, `failed` has no automatic retries left, and `cancelled` means the source or its webhook was removed.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * URL the webhook is sent to.
     */
    #[Required]
    public string $url;

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
     * `new DeliveryGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliveryGetResponse::with(
     *   id: ...,
     *   createdAt: ...,
     *   deliveredAt: ...,
     *   event: ...,
     *   eventID: ...,
     *   lastAttempt: ...,
     *   lastError: ...,
     *   nextAttemptAt: ...,
     *   retry: ...,
     *   retryExpiresAt: ...,
     *   source: ...,
     *   status: ...,
     *   url: ...,
     *   requestID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeliveryGetResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDeliveredAt(...)
     *   ->withEvent(...)
     *   ->withEventID(...)
     *   ->withLastAttempt(...)
     *   ->withLastError(...)
     *   ->withNextAttemptAt(...)
     *   ->withRetry(...)
     *   ->withRetryExpiresAt(...)
     *   ->withSource(...)
     *   ->withStatus(...)
     *   ->withURL(...)
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
     * @param Event|value-of<Event> $event
     * @param Attempt|AttemptShape $lastAttempt
     * @param LastError|LastErrorShape|null $lastError
     * @param RetryConfig|RetryConfigShape $retry
     * @param SourceShape $source
     * @param Status|value-of<Status> $status
     * @param KeyMetadata|KeyMetadataShape|null $keyMetadata
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        ?\DateTimeInterface $deliveredAt,
        Event|string $event,
        string $eventID,
        Attempt|array $lastAttempt,
        LastError|array|null $lastError,
        ?\DateTimeInterface $nextAttemptAt,
        RetryConfig|array $retry,
        \DateTimeInterface $retryExpiresAt,
        Batch|array|Monitor $source,
        Status|string $status,
        string $url,
        string $requestID,
        KeyMetadata|array|null $keyMetadata = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['deliveredAt'] = $deliveredAt;
        $self['event'] = $event;
        $self['eventID'] = $eventID;
        $self['lastAttempt'] = $lastAttempt;
        $self['lastError'] = $lastError;
        $self['nextAttemptAt'] = $nextAttemptAt;
        $self['retry'] = $retry;
        $self['retryExpiresAt'] = $retryExpiresAt;
        $self['source'] = $source;
        $self['status'] = $status;
        $self['url'] = $url;
        $self['requestID'] = $requestID;

        null !== $keyMetadata && $self['keyMetadata'] = $keyMetadata;

        return $self;
    }

    /**
     * Unique ID of the delivery.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the event was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * When the delivery last succeeded. `null` until it succeeds.
     */
    public function withDeliveredAt(?\DateTimeInterface $deliveredAt): self
    {
        $self = clone $this;
        $self['deliveredAt'] = $deliveredAt;

        return $self;
    }

    /**
     * Event that triggered the delivery.
     *
     * @param Event|value-of<Event> $event
     */
    public function withEvent(Event|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * Event ID, sent as `X-Context-Id` and as `id` in the payload. It stays the same across retries, so use it to deduplicate.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * @param Attempt|AttemptShape $lastAttempt
     */
    public function withLastAttempt(Attempt|array $lastAttempt): self
    {
        $self = clone $this;
        $self['lastAttempt'] = $lastAttempt;

        return $self;
    }

    /**
     * Most recent delivery error. `null` when there is none.
     *
     * @param LastError|LastErrorShape|null $lastError
     */
    public function withLastError(LastError|array|null $lastError): self
    {
        $self = clone $this;
        $self['lastError'] = $lastError;

        return $self;
    }

    /**
     * When the next attempt is scheduled. `null` when none is scheduled.
     */
    public function withNextAttemptAt(?\DateTimeInterface $nextAttemptAt): self
    {
        $self = clone $this;
        $self['nextAttemptAt'] = $nextAttemptAt;

        return $self;
    }

    /**
     * Automatic retry settings. Pass `{}` for the default schedule.
     *
     * @param RetryConfig|RetryConfigShape $retry
     */
    public function withRetry(RetryConfig|array $retry): self
    {
        $self = clone $this;
        $self['retry'] = $retry;

        return $self;
    }

    /**
     * Last time you can retry the delivery manually, 7 days after the event.
     */
    public function withRetryExpiresAt(\DateTimeInterface $retryExpiresAt): self
    {
        $self = clone $this;
        $self['retryExpiresAt'] = $retryExpiresAt;

        return $self;
    }

    /**
     * Batch or monitor run that produced the event.
     *
     * @param SourceShape $source
     */
    public function withSource(Batch|array|Monitor $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * Delivery state. `pending` is waiting for an attempt, `delivering` has an attempt in progress, `retrying` is waiting for an automatic retry, `delivered` was acknowledged with a 2xx, `failed` has no automatic retries left, and `cancelled` means the source or its webhook was removed.
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
     * URL the webhook is sent to.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

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
