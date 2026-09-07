<?php

declare(strict_types=1);

namespace ContextDev\Webhooks\Deliveries\Delivery;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Webhooks\Deliveries\Attempt\Error;
use ContextDev\Webhooks\Deliveries\Attempt\Trigger;

/**
 * @phpstan-import-type ErrorShape from \ContextDev\Webhooks\Deliveries\Attempt\Error
 *
 * @phpstan-type LastAttemptShape = array{
 *   id: string,
 *   attempt: int,
 *   completedAt: \DateTimeInterface|null,
 *   error: null|Error|ErrorShape,
 *   httpStatus: int|null,
 *   startedAt: \DateTimeInterface,
 *   trigger: Trigger|value-of<Trigger>,
 *   url: string,
 * }
 */
final class LastAttempt implements BaseModel
{
    /** @use SdkModel<LastAttemptShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public int $attempt;

    #[Required('completed_at')]
    public ?\DateTimeInterface $completedAt;

    #[Required]
    public ?Error $error;

    #[Required('http_status')]
    public ?int $httpStatus;

    #[Required('started_at')]
    public \DateTimeInterface $startedAt;

    /** @var value-of<Trigger> $trigger */
    #[Required(enum: Trigger::class)]
    public string $trigger;

    #[Required]
    public string $url;

    /**
     * `new LastAttempt()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LastAttempt::with(
     *   id: ...,
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
     * (new LastAttempt)
     *   ->withID(...)
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
        string $id,
        int $attempt,
        ?\DateTimeInterface $completedAt,
        Error|array|null $error,
        ?int $httpStatus,
        \DateTimeInterface $startedAt,
        Trigger|string $trigger,
        string $url,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['attempt'] = $attempt;
        $self['completedAt'] = $completedAt;
        $self['error'] = $error;
        $self['httpStatus'] = $httpStatus;
        $self['startedAt'] = $startedAt;
        $self['trigger'] = $trigger;
        $self['url'] = $url;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withAttempt(int $attempt): self
    {
        $self = clone $this;
        $self['attempt'] = $attempt;

        return $self;
    }

    public function withCompletedAt(?\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

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

    public function withHTTPStatus(?int $httpStatus): self
    {
        $self = clone $this;
        $self['httpStatus'] = $httpStatus;

        return $self;
    }

    public function withStartedAt(\DateTimeInterface $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * @param Trigger|value-of<Trigger> $trigger
     */
    public function withTrigger(Trigger|string $trigger): self
    {
        $self = clone $this;
        $self['trigger'] = $trigger;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
