<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListRunsResponse\Data;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListRunsResponse\Data\WebhookDelivery\Error;
use ContextDev\Monitors\MonitorListRunsResponse\Data\WebhookDelivery\Event;
use ContextDev\Monitors\MonitorListRunsResponse\Data\WebhookDelivery\Status;

/**
 * Deprecated: use `webhook_deliveries`, which records every attempt now that a run can deliver multiple events. Omitted when no webhook was attempted, including historical runs created before delivery tracking was added.
 *
 * @deprecated
 *
 * @phpstan-import-type ErrorShape from \ContextDev\Monitors\MonitorListRunsResponse\Data\WebhookDelivery\Error
 *
 * @phpstan-type WebhookDeliveryShape = array{
 *   attemptedAt: \DateTimeInterface,
 *   error: null|\ContextDev\Monitors\MonitorListRunsResponse\Data\WebhookDelivery\Error|ErrorShape,
 *   event: Event|value-of<Event>,
 *   eventID: string,
 *   httpStatus: int|null,
 *   status: \ContextDev\Monitors\MonitorListRunsResponse\Data\WebhookDelivery\Status|value-of<\ContextDev\Monitors\MonitorListRunsResponse\Data\WebhookDelivery\Status>,
 * }
 */
final class WebhookDelivery implements BaseModel
{
    /** @use SdkModel<WebhookDeliveryShape> */
    use SdkModel;

    #[Required('attempted_at')]
    public \DateTimeInterface $attemptedAt;

    #[Required]
    public ?Error $error;

    /**
     * The event this delivery carried. Deliveries recorded before event selection existed report change.detected.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * Identifier sent in the X-Context-Id header.
     */
    #[Required('event_id')]
    public string $eventID;

    /**
     * The endpoint's final HTTP response status, or null when no response was received.
     */
    #[Required('http_status')]
    public ?int $httpStatus;

    /**
     * Delivery outcome. delivered means any 2xx response; rejected means a non-2xx response; failed means no HTTP response was received; skipped_unsafe_url means the URL failed the public-endpoint safety check.
     *
     * @var value-of<Status> $status
     */
    #[Required(
        enum: Status::class,
    )]
    public string $status;

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
    ): self {
        $self = new self;

        $self['attemptedAt'] = $attemptedAt;
        $self['error'] = $error;
        $self['event'] = $event;
        $self['eventID'] = $eventID;
        $self['httpStatus'] = $httpStatus;
        $self['status'] = $status;

        return $self;
    }

    public function withAttemptedAt(\DateTimeInterface $attemptedAt): self
    {
        $self = clone $this;
        $self['attemptedAt'] = $attemptedAt;

        return $self;
    }

    /**
     * @param Error|ErrorShape|null $error
     */
    public function withError(
        Error|array|null $error,
    ): self {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * The event this delivery carried. Deliveries recorded before event selection existed report change.detected.
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
     * Identifier sent in the X-Context-Id header.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * The endpoint's final HTTP response status, or null when no response was received.
     */
    public function withHTTPStatus(?int $httpStatus): self
    {
        $self = clone $this;
        $self['httpStatus'] = $httpStatus;

        return $self;
    }

    /**
     * Delivery outcome. delivered means any 2xx response; rejected means a non-2xx response; failed means no HTTP response was received; skipped_unsafe_url means the URL failed the public-endpoint safety check.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status,
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
