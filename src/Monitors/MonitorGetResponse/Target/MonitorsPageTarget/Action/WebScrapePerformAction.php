<?php

declare(strict_types=1);

namespace ContextDev\Monitors\MonitorGetResponse\Target\MonitorsPageTarget\Action;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * Resolve and perform one natural-language browser action.
 *
 * @phpstan-type WebScrapePerformActionShape = array{action: string, do: 'perform'}
 */
final class WebScrapePerformAction implements BaseModel
{
    /** @use SdkModel<WebScrapePerformActionShape> */
    use SdkModel;

    /**
     * Use `perform` for a plain-language browser instruction.
     *
     * @var 'perform' $do
     */
    #[Required]
    public string $do = 'perform';

    /**
     * One browser instruction, such as clicking a button or entering text.
     */
    #[Required]
    public string $action;

    /**
     * `new WebScrapePerformAction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebScrapePerformAction::with(action: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebScrapePerformAction)->withAction(...)
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
    public static function with(string $action): self
    {
        $self = new self;

        $self['action'] = $action;

        return $self;
    }

    /**
     * One browser instruction, such as clicking a button or entering text.
     */
    public function withAction(string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    /**
     * Use `perform` for a plain-language browser instruction.
     *
     * @param 'perform' $do
     */
    public function withDo(string $do): self
    {
        $self = clone $this;
        $self['do'] = $do;

        return $self;
    }
}
