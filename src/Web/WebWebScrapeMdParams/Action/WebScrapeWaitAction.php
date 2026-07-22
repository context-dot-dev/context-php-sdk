<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebScrapeMdParams\Action;

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

    /** @var 'wait' $do */
    #[Required]
    public string $do = 'wait';

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
     * @param 'wait' $do
     */
    public function withDo(string $do): self
    {
        $self = clone $this;
        $self['do'] = $do;

        return $self;
    }

    public function withTimeMs(int $timeMs): self
    {
        $self = clone $this;
        $self['timeMs'] = $timeMs;

        return $self;
    }
}
