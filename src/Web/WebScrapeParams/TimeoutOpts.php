<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\TimeoutOpts\Behavior;

/**
 * Deadline for the whole request. Defaults to 90000 ms with `fail`. Fixed waits must end before it.
 *
 * @phpstan-type TimeoutOptsShape = array{
 *   milliseconds: int, behavior?: null|Behavior|value-of<Behavior>
 * }
 */
final class TimeoutOpts implements BaseModel
{
    /** @use SdkModel<TimeoutOptsShape> */
    use SdkModel;

    /**
     * Deadline in milliseconds.
     */
    #[Required]
    public int $milliseconds;

    /**
     * "fail" returns 408 at the deadline. "return-partial" returns available results; inspect the response’s partial flag. "return-partial" requires at least 5000 ms.
     *
     * @var value-of<Behavior>|null $behavior
     */
    #[Optional(enum: Behavior::class)]
    public ?string $behavior;

    /**
     * `new TimeoutOpts()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TimeoutOpts::with(milliseconds: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TimeoutOpts)->withMilliseconds(...)
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
     * @param Behavior|value-of<Behavior>|null $behavior
     */
    public static function with(
        int $milliseconds,
        Behavior|string|null $behavior = null
    ): self {
        $self = new self;

        $self['milliseconds'] = $milliseconds;

        null !== $behavior && $self['behavior'] = $behavior;

        return $self;
    }

    /**
     * Deadline in milliseconds.
     */
    public function withMilliseconds(int $milliseconds): self
    {
        $self = clone $this;
        $self['milliseconds'] = $milliseconds;

        return $self;
    }

    /**
     * "fail" returns 408 at the deadline. "return-partial" returns available results; inspect the response’s partial flag. "return-partial" requires at least 5000 ms.
     *
     * @param Behavior|value-of<Behavior> $behavior
     */
    public function withBehavior(Behavior|string $behavior): self
    {
        $self = clone $this;
        $self['behavior'] = $behavior;

        return $self;
    }
}
