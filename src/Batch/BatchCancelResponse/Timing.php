<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchCancelResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * There is no finish time yet — the batch is still winding down.
 *
 * @phpstan-type TimingShape = array{createdAt: string, startedAt: string|null}
 */
final class Timing implements BaseModel
{
    /** @use SdkModel<TimingShape> */
    use SdkModel;

    /**
     * When the batch was created.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * When processing started. Null if it was cancelled while still queued.
     */
    #[Required('started_at')]
    public ?string $startedAt;

    /**
     * `new Timing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Timing::with(createdAt: ..., startedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Timing)->withCreatedAt(...)->withStartedAt(...)
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
     */
    public static function with(string $createdAt, ?string $startedAt): self
    {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * When the batch was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * When processing started. Null if it was cancelled while still queued.
     */
    public function withStartedAt(?string $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }
}
