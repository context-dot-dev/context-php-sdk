<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\Delivery\Event;
use ContextDev\Webhooks\Deliveries\Delivery\LastAttempt;
use ContextDev\Webhooks\Deliveries\Delivery\LastError;
use ContextDev\Webhooks\Deliveries\Delivery\Source\UnionMember0;
use ContextDev\Webhooks\Deliveries\Delivery\Source\UnionMember1;
use ContextDev\Webhooks\Deliveries\Delivery\Status;
use ContextDev\Webhooks\RetryConfig;

/**
 * @phpstan-import-type SourceVariants from \ContextDev\Webhooks\Deliveries\Delivery\Source
 * @phpstan-import-type LastAttemptShape from \ContextDev\Webhooks\Deliveries\Delivery\LastAttempt
 * @phpstan-import-type LastErrorShape from \ContextDev\Webhooks\Deliveries\Delivery\LastError
 * @phpstan-import-type RetryConfigShape from \ContextDev\Webhooks\RetryConfig
 * @phpstan-import-type SourceShape from \ContextDev\Webhooks\Deliveries\Delivery\Source
 *
 * @phpstan-type DeliveryShape = array{
 *   id: string,
 *   attemptCount: int,
 *   createdAt: \DateTimeInterface,
 *   deliveredAt: \DateTimeInterface|null,
 *   event: Event|value-of<Event>,
 *   eventID: string,
 *   lastAttempt: LastAttempt|LastAttemptShape,
 *   lastError: null|LastError|LastErrorShape,
 *   nextAttemptAt: \DateTimeInterface|null,
 *   retry: RetryConfig|RetryConfigShape,
 *   retryExpiresAt: \DateTimeInterface,
 *   source: SourceShape,
 *   status: Status|value-of<Status>,
 *   url: string,
 * }
 */
final class Delivery implements BaseModel
{
    /** @use SdkModel<DeliveryShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * Number of delivery attempts started, including any attempt in progress.
     */
    #[Required('attempt_count')]
    public int $attemptCount;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Most recent successful acknowledgment; retained if a later forced resend fails.
     */
    #[Required('delivered_at')]
    public ?\DateTimeInterface $deliveredAt;

    /** @var value-of<Event> $event */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * Stable event ID. Unchanged across automatic and manual attempts; use it to deduplicate events.
     */
    #[Required('event_id')]
    public string $eventID;

    #[Required('last_attempt')]
    public LastAttempt $lastAttempt;

    #[Required('last_error')]
    public ?LastError $lastError;

    #[Required('next_attempt_at')]
    public ?\DateTimeInterface $nextAttemptAt;

    /**
     * Opt into durable webhook delivery. An empty object uses the default retry schedule. Omit retry to preserve legacy delivery behavior. The policy is snapshotted for each event.
     */
    #[Required]
    public RetryConfig $retry;

    /**
     * Seven days after event creation. Manual retries after this time return 410. Delivery and attempt metadata remain available for up to 30 days.
     */
    #[Required('retry_expires_at')]
    public \DateTimeInterface $retryExpiresAt;

    /** @var SourceVariants $source */
    #[Required]
    public UnionMember0|UnionMember1 $source;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Destination recorded for this delivery. Each attempt records the URL it used. Monitor retries use the currently configured URL and signing secret.
     */
    #[Required]
    public string $url;

    /**
     * `new Delivery()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Delivery::with(
     *   id: ...,
     *   attemptCount: ...,
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
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Delivery)
     *   ->withID(...)
     *   ->withAttemptCount(...)
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
     * @param LastAttempt|LastAttemptShape $lastAttempt
     * @param LastError|LastErrorShape|null $lastError
     * @param RetryConfig|RetryConfigShape $retry
     * @param SourceShape $source
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        int $attemptCount,
        \DateTimeInterface $createdAt,
        ?\DateTimeInterface $deliveredAt,
        Event|string $event,
        string $eventID,
        LastAttempt|array $lastAttempt,
        LastError|array|null $lastError,
        ?\DateTimeInterface $nextAttemptAt,
        RetryConfig|array $retry,
        \DateTimeInterface $retryExpiresAt,
        UnionMember0|array|UnionMember1 $source,
        Status|string $status,
        string $url,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['attemptCount'] = $attemptCount;
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

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of delivery attempts started, including any attempt in progress.
     */
    public function withAttemptCount(int $attemptCount): self
    {
        $self = clone $this;
        $self['attemptCount'] = $attemptCount;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Most recent successful acknowledgment; retained if a later forced resend fails.
     */
    public function withDeliveredAt(?\DateTimeInterface $deliveredAt): self
    {
        $self = clone $this;
        $self['deliveredAt'] = $deliveredAt;

        return $self;
    }

    /**
     * @param Event|value-of<Event> $event
     */
    public function withEvent(Event|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * Stable event ID. Unchanged across automatic and manual attempts; use it to deduplicate events.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * @param LastAttempt|LastAttemptShape $lastAttempt
     */
    public function withLastAttempt(LastAttempt|array $lastAttempt): self
    {
        $self = clone $this;
        $self['lastAttempt'] = $lastAttempt;

        return $self;
    }

    /**
     * @param LastError|LastErrorShape|null $lastError
     */
    public function withLastError(LastError|array|null $lastError): self
    {
        $self = clone $this;
        $self['lastError'] = $lastError;

        return $self;
    }

    public function withNextAttemptAt(?\DateTimeInterface $nextAttemptAt): self
    {
        $self = clone $this;
        $self['nextAttemptAt'] = $nextAttemptAt;

        return $self;
    }

    /**
     * Opt into durable webhook delivery. An empty object uses the default retry schedule. Omit retry to preserve legacy delivery behavior. The policy is snapshotted for each event.
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
     * Seven days after event creation. Manual retries after this time return 410. Delivery and attempt metadata remain available for up to 30 days.
     */
    public function withRetryExpiresAt(\DateTimeInterface $retryExpiresAt): self
    {
        $self = clone $this;
        $self['retryExpiresAt'] = $retryExpiresAt;

        return $self;
    }

    /**
     * @param SourceShape $source
     */
    public function withSource(UnionMember0|array|UnionMember1 $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

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
     * Destination recorded for this delivery. Each attempt records the URL it used. Monitor retries use the currently configured URL and signing secret.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
