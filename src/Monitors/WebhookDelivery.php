<?php

declare(strict_types=1);

namespace ContextDev\Monitors;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\WebhookDelivery\Error;
use ContextDev\Monitors\WebhookDelivery\Event;
use ContextDev\Monitors\WebhookDelivery\Status;

/**
 * @phpstan-import-type ErrorShape from \ContextDev\Monitors\WebhookDelivery\Error
 *
 * @phpstan-type WebhookDeliveryShape = array{
 *   attemptedAt: \DateTimeInterface,
 *   error: null|Error|ErrorShape,
 *   event: Event|value-of<Event>,
 *   eventID: string,
 *   httpStatus: int|null,
 *   status: Status|value-of<Status>,
 *   deliveryID?: string|null,
 * }
 */
final class WebhookDelivery implements BaseModel
{
    /** @use SdkModel<WebhookDeliveryShape> */
    use SdkModel;

    /**
     * When the delivery was attempted.
     */
    #[Required('attempted_at')]
    public \DateTimeInterface $attemptedAt;

    #[Required]
    public ?Error $error;

    /**
     * Event this delivery carried.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * Event ID, sent in the `X-Context-Id` header.
     */
    #[Required('event_id')]
    public string $eventID;

    /**
     * Final HTTP status from your endpoint. `null` when no response was received.
     */
    #[Required('http_status')]
    public ?int $httpStatus;

    /**
     * Outcome of the delivery: `delivered` (2xx response), `rejected` (non-2xx response), `failed` (no response), or `skipped_unsafe_url` (the URL isn't a safe public endpoint).
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * ID for looking up or retrying this delivery, when available.
     */
    #[Optional('delivery_id')]
    public ?string $deliveryID;

    /**
     * `new WebhookDelivery()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookDelivery::with(
     *   attemptedAt: ...,
     *   error: ...,
     *   event: ...,
     *   eventID: ...,
     *   httpStatus: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookDelivery)
     *   ->withAttemptedAt(...)
     *   ->withError(...)
     *   ->withEvent(...)
     *   ->withEventID(...)
     *   ->withHTTPStatus(...)
     *   ->withStatus(...)
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
     * @param Error|ErrorShape|null $error
     * @param Event|value-of<Event> $event
     * @param Status|value-of<Status> $status
     */
    public static function with(
        \DateTimeInterface $attemptedAt,
        Error|array|null $error,
        Event|string $event,
        string $eventID,
        ?int $httpStatus,
        Status|string $status,
        ?string $deliveryID = null,
    ): self {
        $self = new self;

        $self['attemptedAt'] = $attemptedAt;
        $self['error'] = $error;
        $self['event'] = $event;
        $self['eventID'] = $eventID;
        $self['httpStatus'] = $httpStatus;
        $self['status'] = $status;

        null !== $deliveryID && $self['deliveryID'] = $deliveryID;

        return $self;
    }

    /**
     * When the delivery was attempted.
     */
    public function withAttemptedAt(\DateTimeInterface $attemptedAt): self
    {
        $self = clone $this;
        $self['attemptedAt'] = $attemptedAt;

        return $self;
    }

    /**
     * @param Error|ErrorShape|null $error
     */
    public function withError(Error|array|null $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Event this delivery carried.
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
     * Event ID, sent in the `X-Context-Id` header.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * Final HTTP status from your endpoint. `null` when no response was received.
     */
    public function withHTTPStatus(?int $httpStatus): self
    {
        $self = clone $this;
        $self['httpStatus'] = $httpStatus;

        return $self;
    }

    /**
     * Outcome of the delivery: `delivered` (2xx response), `rejected` (non-2xx response), `failed` (no response), or `skipped_unsafe_url` (the URL isn't a safe public endpoint).
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
     * ID for looking up or retrying this delivery, when available.
     */
    public function withDeliveryID(string $deliveryID): self
    {
        $self = clone $this;
        $self['deliveryID'] = $deliveryID;

        return $self;
    }
}
