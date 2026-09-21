<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScrapeParams\ScreenshotParams\Area;

use ContextDev\Core\Attributes\Required;
use ContextDev\Core\Concerns\SdkModel;
use ContextDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ElementShape = array{selector: string}
 */
final class Element implements BaseModel
{
    /** @use SdkModel<ElementShape> */
    use SdkModel;

    /**
     * Must match one visible element.
     */
    #[Required]
    public string $selector;

    /**
     * `new Element()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Element::with(selector: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Element)->withSelector(...)
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
    public static function with(string $selector): self
    {
        $self = new self;

        $self['selector'] = $selector;

        return $self;
    }

    /**
     * Must match one visible element.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }
}
