<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\Attempt\Error;
use ContextDev\Webhooks\Deliveries\Attempt\Trigger;

/**
 * @phpstan-import-type ErrorShape from \ContextDev\Webhooks\Deliveries\Attempt\Error
 *
 * @phpstan-type AttemptShape = array{
 *   attempt: int,
 *   completedAt: \DateTimeInterface|null,
 *   error: null|Error|ErrorShape,
 *   httpStatus: int|null,
 *   startedAt: \DateTimeInterface,
 *   trigger: Trigger|value-of<Trigger>,
 *   url: string,
 * }
 */
final class Attempt implements BaseModel
{
    /** @use SdkModel<AttemptShape> */
    use SdkModel;

    /**
     * Attempt number, starting at 1.
     */
    #[Required]
    public int $attempt;

    /**
     * Completion time, or null while in progress.
     */
    #[Required('completed_at')]
    public ?\DateTimeInterface $completedAt;

    /**
     * Attempt error, or null if none.
     */
    #[Required]
    public ?Error $error;

    /**
     * HTTP response status, or null if no response was received.
     */
    #[Required('http_status')]
    public ?int $httpStatus;

    /**
     * Attempt start time.
     */
    #[Required('started_at')]
    public \DateTimeInterface $startedAt;

    /**
     * What started this attempt.
     *
     * @var value-of<Trigger> $trigger
     */
    #[Required(enum: Trigger::class)]
    public string $trigger;

    /**
     * URL used for this attempt.
     */
    #[Required]
    public string $url;

    /**
     * `new Attempt()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Attempt::with(
     *   attempt: ...,
     *   completedAt: ...,
     *   error: ...,
     *   httpStatus: ...,
     *   startedAt: ...,
     *   trigger: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Attempt)
     *   ->withAttempt(...)
     *   ->withCompletedAt(...)
     *   ->withError(...)
     *   ->withHTTPStatus(...)
     *   ->withStartedAt(...)
     *   ->withTrigger(...)
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
     * @param Error|ErrorShape|null $error
     * @param Trigger|value-of<Trigger> $trigger
     */
    public static function with(
        int $attempt,
        ?\DateTimeInterface $completedAt,
        Error|array|null $error,
        ?int $httpStatus,
        \DateTimeInterface $startedAt,
        Trigger|string $trigger,
        string $url,
    ): self {
        $self = new self;

        $self['attempt'] = $attempt;
        $self['completedAt'] = $completedAt;
        $self['error'] = $error;
        $self['httpStatus'] = $httpStatus;
        $self['startedAt'] = $startedAt;
        $self['trigger'] = $trigger;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Attempt number, starting at 1.
     */
    public function withAttempt(int $attempt): self
    {
        $self = clone $this;
        $self['attempt'] = $attempt;

        return $self;
    }

    /**
     * Completion time, or null while in progress.
     */
    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * Attempt error, or null if none.
     *
     * @param Error|ErrorShape|null $error
     */
    public function withError(Error|array|null $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * HTTP response status, or null if no response was received.
     */
    public function withHTTPStatus(?int $httpStatus): self
    {
        $self = clone $this;
        $self['httpStatus'] = $httpStatus;

        return $self;
    }

    /**
     * Attempt start time.
     */
    public function withStartedAt(\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * What started this attempt.
     *
     * @param Trigger|value-of<Trigger> $trigger
     */
    public function withTrigger(Trigger|string $trigger): self
    {
        $self = clone $this;
        $self['trigger'] = $trigger;

        return $self;
    }

    /**
     * URL used for this attempt.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
