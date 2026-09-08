<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\DeliverySummary\Event;
use ContextDev\Webhooks\Deliveries\DeliverySummary\LastError;
use ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Batch;
use ContextDev\Webhooks\Deliveries\DeliverySummary\Source\Monitor;
use ContextDev\Webhooks\Deliveries\DeliverySummary\Status;

/**
 * @phpstan-import-type SourceVariants from \ContextDev\Webhooks\Deliveries\DeliverySummary\Source
 * @phpstan-import-type LastErrorShape from \ContextDev\Webhooks\Deliveries\DeliverySummary\LastError
 * @phpstan-import-type SourceShape from \ContextDev\Webhooks\Deliveries\DeliverySummary\Source
 *
 * @phpstan-type DeliverySummaryShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   deliveredAt: \DateTimeInterface|null,
 *   event: Event|value-of<Event>,
 *   lastError: null|LastError|LastErrorShape,
 *   nextAttemptAt: \DateTimeInterface|null,
 *   retryExpiresAt: \DateTimeInterface,
 *   source: SourceShape,
 *   status: Status|value-of<Status>,
 *   url: string,
 * }
 */
final class DeliverySummary implements BaseModel
{
    /** @use SdkModel<DeliverySummaryShape> */
    use SdkModel;

    /**
     * Delivery ID.
     */
    #[Required]
    public string $id;

    /**
     * Event creation time.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Last successful delivery time, or null if never delivered.
     */
    #[Required('delivered_at')]
    public ?\DateTimeInterface $deliveredAt;

    /**
     * Webhook event type.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * Latest delivery error, or null if none.
     */
    #[Required('last_error')]
    public ?LastError $lastError;

    /**
     * Next scheduled attempt, or null if none.
     */
    #[Required('next_attempt_at')]
    public ?\DateTimeInterface $nextAttemptAt;

    /**
     * Manual retry deadline, seven days after event creation.
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
     * Current delivery status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Webhook destination URL.
     */
    #[Required]
    public string $url;

    /**
     * `new DeliverySummary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliverySummary::with(
     *   id: ...,
     *   createdAt: ...,
     *   deliveredAt: ...,
     *   event: ...,
     *   lastError: ...,
     *   nextAttemptAt: ...,
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
     * (new DeliverySummary)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDeliveredAt(...)
     *   ->withEvent(...)
     *   ->withLastError(...)
     *   ->withNextAttemptAt(...)
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
     * @param LastError|LastErrorShape|null $lastError
     * @param SourceShape $source
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        ?\DateTimeInterface $deliveredAt,
        Event|string $event,
        LastError|array|null $lastError,
        ?\DateTimeInterface $nextAttemptAt,
        \DateTimeInterface $retryExpiresAt,
        Batch|array|Monitor $source,
        Status|string $status,
        string $url,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['deliveredAt'] = $deliveredAt;
        $self['event'] = $event;
        $self['lastError'] = $lastError;
        $self['nextAttemptAt'] = $nextAttemptAt;
        $self['retryExpiresAt'] = $retryExpiresAt;
        $self['source'] = $source;
        $self['status'] = $status;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Delivery ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Event creation time.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Last successful delivery time, or null if never delivered.
     */
    public function withDeliveredAt(?\DateTimeInterface $deliveredAt): self
    {
        $self = clone $this;
        $self['deliveredAt'] = $deliveredAt;

        return $self;
    }

    /**
     * Webhook event type.
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
     * Latest delivery error, or null if none.
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
     * Next scheduled attempt, or null if none.
     */
    public function withNextAttemptAt(?\DateTimeInterface $nextAttemptAt): self
    {
        $self = clone $this;
        $self['nextAttemptAt'] = $nextAttemptAt;

        return $self;
    }

    /**
     * Manual retry deadline, seven days after event creation.
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
     * Current delivery status.
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
     * Webhook destination URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
