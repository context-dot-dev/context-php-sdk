<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScreenshotParams\TimeoutOpts\Behavior;

/**
 * Request deadline and what to return when it passes.
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
     * "fail" returns 408 at the deadline. "return-partial" returns available results; inspect the response’s partial flag. "return-partial" requires at least 5000 ms. On POST /web/scrape, an output that is not ready in time fails with error_code REQUEST_TIMEOUT inside a 200 response under either behavior; 408 is returned only when the whole request cannot respond by the deadline.
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
     * "fail" returns 408 at the deadline. "return-partial" returns available results; inspect the response’s partial flag. "return-partial" requires at least 5000 ms. On POST /web/scrape, an output that is not ready in time fails with error_code REQUEST_TIMEOUT inside a 200 response under either behavior; 408 is returned only when the whole request cannot respond by the deadline.
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
