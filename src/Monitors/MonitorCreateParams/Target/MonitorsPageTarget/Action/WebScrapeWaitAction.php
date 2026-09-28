<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorCreateParams\Target\MonitorsPageTarget\Action;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Pause for a fixed number of milliseconds before continuing to the next action.
 *
 * @phpstan-type WebScrapeWaitActionShape = array{do: 'wait', timeMs: int}
 */
final class WebScrapeWaitAction implements BaseModel
{
    /** @use SdkModel<WebScrapeWaitActionShape> */
    use SdkModel;

    /**
     * Use `wait` to pause for a fixed duration.
     *
     * @var 'wait' $do
     */
    #[Required]
    public string $do = 'wait';

    /**
     * Time to pause in milliseconds before the next action.
     */
    #[Required]
    public int $timeMs;

    /**
     * `new WebScrapeWaitAction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebScrapeWaitAction::with(timeMs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebScrapeWaitAction)->withTimeMs(...)
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
    public static function with(int $timeMs): self
    {
        $self = new self;

        $self['timeMs'] = $timeMs;

        return $self;
    }

    /**
     * Use `wait` to pause for a fixed duration.
     *
     * @param 'wait' $do
     */
    public function withDo(string $do): self
    {
        $self = clone $this;
        $self['do'] = $do;

        return $self;
    }

    /**
     * Time to pause in milliseconds before the next action.
     */
    public function withTimeMs(int $timeMs): self
    {
        $self = clone $this;
        $self['timeMs'] = $timeMs;

        return $self;
    }
}
