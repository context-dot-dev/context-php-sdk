<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams;

use ContextDev\Core\Attributes\Optional;
use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;
use ContextDev\Web\WebScrapeParams\TimeoutOpts\Behavior;

/**
 * Total deadline, including navigation, actions, waiting, and all outputs. Defaults to 60000 milliseconds with behavior fail. Use return-partial to capture the current page state and return captured images if image processing cannot finish before the deadline; these responses set isPartial and are not cached. Every requested format must still be available. Fixed waits must fit before a response reserve of up to 5000 milliseconds (at most one quarter of the timeout) when using return-partial.
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
     * Request deadline in milliseconds. Maximum: 300000 (5 minutes).
     */
    #[Required]
    public int $milliseconds;

    /**
     * What to do at the deadline. "fail" returns 408 REQUEST_TIMEOUT without charging credits. "return-partial" returns usable results collected so far; if none are available, the request still fails without charging credits. Partial results are not cached as complete results. "return-partial" requires milliseconds of at least 5000.
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
     * Request deadline in milliseconds. Maximum: 300000 (5 minutes).
     */
    public function withMilliseconds(int $milliseconds): self
    {
        $self = clone $this;
        $self['milliseconds'] = $milliseconds;

        return $self;
    }

    /**
     * What to do at the deadline. "fail" returns 408 REQUEST_TIMEOUT without charging credits. "return-partial" returns usable results collected so far; if none are available, the request still fails without charging credits. Partial results are not cached as complete results. "return-partial" requires milliseconds of at least 5000.
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
