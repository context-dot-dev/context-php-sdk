<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorListResponse\Data;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Monitors\MonitorListResponse\Data\WebhookFailure\LastStatus;

/**
 * Details of failing webhook deliveries. `null` when deliveries succeed or no webhook is configured; cleared by the next successful delivery or a new webhook URL.
 *
 * @phpstan-type WebhookFailureShape = array{
 *   consecutiveFailures: int,
 *   lastFailedAt: \DateTimeInterface,
 *   lastMessage: string,
 *   lastStatus: LastStatus|value-of<LastStatus>,
 * }
 */
final class WebhookFailure implements BaseModel
{
    /** @use SdkModel<WebhookFailureShape> */
    use SdkModel;

    /**
     * Number of failed delivery attempts in a row.
     */
    #[Required('consecutive_failures')]
    public int $consecutiveFailures;

    /**
     * When the most recent delivery failed.
     */
    #[Required('last_failed_at')]
    public \DateTimeInterface $lastFailedAt;

    /**
     * Human-readable explanation of the most recent failure.
     */
    #[Required('last_message')]
    public string $lastMessage;

    /**
     * Outcome of the most recent failed delivery: `rejected` (non-2xx response), `failed` (no response), or `skipped_unsafe_url` (the URL isn't a safe public endpoint).
     *
     * @var value-of<LastStatus> $lastStatus
     */
    #[Required('last_status', enum: LastStatus::class)]
    public string $lastStatus;

    /**
     * `new WebhookFailure()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookFailure::with(
     *   consecutiveFailures: ..., lastFailedAt: ..., lastMessage: ..., lastStatus: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookFailure)
     *   ->withConsecutiveFailures(...)
     *   ->withLastFailedAt(...)
     *   ->withLastMessage(...)
     *   ->withLastStatus(...)
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
     * @param LastStatus|value-of<LastStatus> $lastStatus
     */
    public static function with(
        int $consecutiveFailures,
        \DateTimeInterface $lastFailedAt,
        string $lastMessage,
        LastStatus|string $lastStatus,
    ): self {
        $self = new self;

        $self['consecutiveFailures'] = $consecutiveFailures;
        $self['lastFailedAt'] = $lastFailedAt;
        $self['lastMessage'] = $lastMessage;
        $self['lastStatus'] = $lastStatus;

        return $self;
    }

    /**
     * Number of failed delivery attempts in a row.
     */
    public function withConsecutiveFailures(int $consecutiveFailures): self
    {
        $self = clone $this;
        $self['consecutiveFailures'] = $consecutiveFailures;

        return $self;
    }

    /**
     * When the most recent delivery failed.
     */
    public function withLastFailedAt(\DateTimeInterface $lastFailedAt): self
    {
        $self = clone $this;
        $self['lastFailedAt'] = $lastFailedAt;

        return $self;
    }

    /**
     * Human-readable explanation of the most recent failure.
     */
    public function withLastMessage(string $lastMessage): self
    {
        $self = clone $this;
        $self['lastMessage'] = $lastMessage;

        return $self;
    }

    /**
     * Outcome of the most recent failed delivery: `rejected` (non-2xx response), `failed` (no response), or `skipped_unsafe_url` (the URL isn't a safe public endpoint).
     *
     * @param LastStatus|value-of<LastStatus> $lastStatus
     */
    public function withLastStatus(LastStatus|string $lastStatus): self
    {
        $self = clone $this;
        $self['lastStatus'] = $lastStatus;

        return $self;
    }
}
