<?php

declare(strict_types=1);

namespace ContextDev\Batch\BatchGetResponse;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type TimingShape = array{
 *   completedAt: string|null, createdAt: string, startedAt: string|null
 * }
 */
final class Timing implements BaseModel
{
    /** @use SdkModel<TimingShape> */
    use SdkModel;

    /**
     * When processing finished. Null while active.
     */
    #[Required('completed_at')]
    public ?string $completedAt;

    /**
     * When the batch was created.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * When processing started. Null while queued.
     */
    #[Required('started_at')]
    public ?string $startedAt;

    /**
     * `new Timing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Timing::with(completedAt: ..., createdAt: ..., startedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Timing)->withCompletedAt(...)->withCreatedAt(...)->withStartedAt(...)
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
    public static function with(
        ?string $completedAt,
        string $createdAt,
        ?string $startedAt
    ): self {
        $self = new self;

        $self['completedAt'] = $completedAt;
        $self['createdAt'] = $createdAt;
        $self['startedAt'] = $startedAt;

        return $self;
    }

    /**
     * When processing finished. Null while active.
     */
    public function withCompletedAt(?string $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

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
     * When processing started. Null while queued.
     */
    public function withStartedAt(?string $startedAt): self
    {
        $self = clone $this;
        $self['startedAt'] = $startedAt;

        return $self;
    }
}
